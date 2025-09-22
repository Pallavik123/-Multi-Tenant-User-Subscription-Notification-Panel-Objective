# Multi-Tenant User Subscription & Notification Panel

This web app where companies (tenants) can register, manage their users, and monitor subscription usage with real-time notifications.

## Feature Summary

* Companies (tenants) table, each company has many users.
* Plans table (Basic / Pro / Enterprise) with limits.
* Usage tracking (usages table) for companies.
* API: `/api/usage` returns current usage for authenticated user's company.
* Auth: Laravel Sanctum token authentication with login endpoint.
* Frontend: Login, Dashboard (plan + usage progress), User list + Invite user.


### Requirement

* PHP 8.2+, Composer
* Node 20
* MySQL



## API Endpoint

* `POST /api/login` — body: `{email, password}` → returns `token` (Bearer)
* `GET /api/usage` — returns current usage and plan limits for the authenticated user's company


# Deployment Steps
* Clone the project repository by running the command below: git clone.
* After cloning, run: composer install
* Duplicate .env.example and rename it .env
* Then run: php artisan key:generate
* Test Backend API Endpoint
* Be sure to fill in your database details in your .env file before running the migrations: php artisan migrate And finally, start the application: php artisan serve and npm start visit http:http://localhost:3000/ to see Frontend the application in action







