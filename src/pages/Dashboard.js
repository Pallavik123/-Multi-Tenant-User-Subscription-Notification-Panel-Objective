import React, { useState, useEffect, useContext } from 'react';
import axios from 'axios';
import { AuthContext } from '../contexts/AuthContext';

function Dashboard() {
  const { token } = useContext(AuthContext);
  const [usage, setUsage] = useState({
    messages_used: 0,
    api_calls_used: 0
  });
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    const fetchUsage = async () => {
      try {
        const response = await axios.get('http://localhost:8000/api/usage', {
          headers: {
            'Authorization': `Bearer ${token}`,
            'Accept': 'application/json'
          }
        });
        console.log('Usage response data:', response.data);
        console.log('Keys:', Object.keys(response.data));

        // if the API returns the usage at top level
        if (
          response.data.messages_used !== undefined &&
          response.data.api_calls_used !== undefined
        ) {
          setUsage({
            messages_used: response.data.messages_used,
            api_calls_used: response.data.api_calls_used
          });
        }
        // else if it's nested under `usage`
        else if (
          response.data.usage &&
          response.data.usage.messages_used !== undefined &&
          response.data.usage.api_calls_used !== undefined
        ) {
          setUsage({
            messages_used: response.data.usage.messages_used,
            api_calls_used: response.data.usage.api_calls_used
          });
        } else {
          console.warn('Usage data shape unexpected:', response.data);
          // Keep defaults or set to something you anticipate
        }
      } catch (err) {
        console.error('Error fetching usage:', err);
        setError('Failed to fetch usage from API');
      } finally {
        setLoading(false);
      }
    };

    if (token) {
      fetchUsage();
    } else {
      setLoading(false);
      setError('No authentication token');
    }
  }, [token]);

  if (loading) return <div>Loading usage...</div>;
  if (error) return <div>{error}</div>;

  return (
    <div>
      <h2>Usage:</h2>
      <p>Messages Used: {usage.messages_used}</p>
      <p>API Calls Used: {usage.api_calls_used}</p>
    </div>
  );
}

export default Dashboard;
