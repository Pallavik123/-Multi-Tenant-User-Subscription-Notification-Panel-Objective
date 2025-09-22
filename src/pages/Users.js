import { useState, useEffect, useContext, useCallback } from 'react';
import axios from 'axios';
import { AuthContext } from '../contexts/AuthContext';

export default function Users() {
  const { token } = useContext(AuthContext);
  const [users, setUsers] = useState([]);
  const [newUser, setNewUser] = useState({ name: '', email: '' });

  const fetchUsers = useCallback(async () => {
    const res = await axios.get('http://localhost:8000/api/users', {
      headers: { Authorization: `Bearer ${token}` }
    });
    setUsers(res.data);
  }, [token]);

  const inviteUser = async () => {
    await axios.post('http://localhost:8000/api/users', newUser, {
      headers: { Authorization: `Bearer ${token}` }
    });
    setNewUser({ name: '', email: '' });
    fetchUsers();
  };

  useEffect(() => {
    fetchUsers();
  }, [fetchUsers]);  // include fetchUsers here

  return (
    <div className="container mt-5">
      <h2>Company Users</h2>

      <ul className="list-group mb-4">
        {users.map(user => (
          <li key={user.id} className="list-group-item">{user.name} - {user.email}</li>
        ))}
      </ul>

      <div>
        <input
          type="text"
          placeholder="Name"
          value={newUser.name}
          onChange={e => setNewUser({ ...newUser, name: e.target.value })}
          className="form-control mb-2"
        />
        <input
          type="email"
          placeholder="Email"
          value={newUser.email}
          onChange={e => setNewUser({ ...newUser, email: e.target.value })}
          className="form-control mb-2"
        />
        <button onClick={inviteUser} className="btn btn-primary">Invite User</button>
      </div>
    </div>
  );
}
