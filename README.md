# Maithil Thal - Luxury Restaurant Website

Premium website for **Maithil Thal**, Janakpurdham, Nepal.

## Deployment Guide (Hostinger / cPanel)

### 1. Database Setup
1. Log in to your Hostinger cPanel.
2. Go to **MySQL Databases**.
3. Create a new database named `maithil_thal`.
4. Create a new MySQL user and assign it to the database with all permissions.
5. Go to **phpMyAdmin**, select the new database, and import the `/database/schema.sql` file.

### 2. File Upload
1. Open **File Manager** in cPanel.
2. Navigate to `public_html`.
3. Upload all files and folders from this project (excluding `node_modules`, `server.ts`, `package.json`, and `tsconfig.json`).
4. Ensure the following structure exists:
   - `/assets`
   - `/css`
   - `/js`
   - `/api`
   - `/includes`
   - `/admin`
   - `index.html`

### 3. Configuration
1. Open `/includes/db.php`.
2. Update the `$username` and `$password` with your cPanel MySQL credentials.
3. Save the file.

### 4. Admin Panel
- The Admin Panel is located at `/admin`.
- Default credentials (configured in database):
  - **Username**: admin
  - **Password**: admin123 (Please change this immediately after login).

## Features
- **Responsive Design**: Mobile-first luxury UI.
- **Mithila Theme**: Traditional borders and patterns.
- **Dynamic Menu**: Manage categories and items from the admin panel.
- **Online Reservations**: Instant table booking requests.
- **SEO Optimized**: Meta tags and local schema included.

## Support
For technical assistance, contact development@maithilthal.com.
