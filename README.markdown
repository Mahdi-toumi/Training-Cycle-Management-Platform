# Training Cycle Management Platform

## About
This project develops a web-based platform for managing training cycles at the Centre National de l'Informatique (CNI). Built using PHP, MySQL, HTML5, CSS3, and JavaScript, it streamlines registration, cycle management, trainer management, and attendance tracking. The platform features a user-friendly interface and a 3-tier architecture, ensuring scalability, data integrity, and efficient administration of training programs.

## Objectives
1. **User Accessibility**: Enable easy registration and access to training cycles for employees and external participants.
2. **Administrative Efficiency**: Provide tools for administrators to manage training cycles, trainers, and participants.
3. **Data Management**: Ensure centralized data storage with real-time updates and reporting capabilities.
4. **Scalability**: Design a flexible system to accommodate future enhancements.

## Features
- **User Features**:
  - Browse and search available training cycles by theme and date.
  - View detailed cycle information (e.g., schedule, location, trainers).
  - Register for training cycles via an intuitive form.
- **Administrator Features**:
  - Authenticate securely to access administrative functions.
  - Add, modify, or deactivate training cycles.
  - Manage trainers (add, update, delete).
  - Generate and print attendance sheets.
  - View and search participant details.
- **Technical Features**:
  - 3-tier architecture (Client, Application, Data).
  - MySQL database for robust data storage.
  - Responsive design using HTML5 and CSS3.
  - Dynamic interactivity with JavaScript.

## Technologies
- **Backend**: PHP 8.1, MySQL
- **Frontend**: HTML5, CSS3, JavaScript
- **Tools**:
  - Visual Studio Code (code editor)
  - XAMPP v3.2.1 (local server with Apache, MySQL, phpMyAdmin)
  - StarUML (UML modeling)
- **Development Environment**: Windows 11, HP Pavilion 15 (AMD Ryzen 7, 16GB RAM, 512GB SSD)

## Installation
1. **Prerequisites**:
   - XAMPP v3.2.1 or higher
   - PHP 8.1 or higher
   - MySQL
   - A modern web browser (e.g., Chrome, Firefox)
2. **Setup**:
   - Clone the repository: `git clone https://github.com/Mahdi-toumi/Training-Cycle-Management-Platform.git`
   - Copy the project files to the `htdocs` folder in your XAMPP installation.
   - Start XAMPP and ensure Apache and MySQL services are running.
   - Import the provided `database.sql` script into MySQL via phpMyAdmin to set up the database.
3. **Run**:
   - Open a browser and navigate to `http://localhost/your-project-folder`.
   - Log in as an administrator or user to explore the platform.

## Project Structure
- `database.sql`: SQL script for creating and populating the MySQL database.
- `src/`:
  - `php/`: Backend PHP scripts for handling requests and database operations.
  - `css/`: Stylesheets for responsive design.
  - `js/`: JavaScript files for dynamic functionality.
  - `html/`: HTML templates for user and admin interfaces.
- `docs/`: Project documentation, including the internship report.
- `diagrams/`: UML diagrams (use case, class, activity, sequence).

## Usage
1. **Database Setup**:
   - Run `database.sql` in phpMyAdmin to create tables for cycles, participants, and trainers.
2. **Access the Platform**:
   - **Users**: Browse cycles, view details, and register via the user interface.
   - **Administrators**: Log in to manage cycles, trainers, and participants, or generate attendance sheets.
3. **Example Operations**:
   - Add a training cycle: Input details like theme, dates, location, and trainers.
   - Register for a cycle: Fill out the registration form with personal and company details.
   - Print attendance: Select a cycle and generate a formatted attendance sheet.

## Key Components
- **Database Tables**:
  - `Cycle`: Stores training cycle details (ID, theme, dates, trainers, etc.).
  - `Participant`: Manages participant data (ID, name, company, cycle ID).
  - `Formateur`: Tracks trainer information (ID, name, specialty).
- **Interfaces**:
  - User: Homepage, cycle details, registration form.
  - Admin: Dashboard, cycle/trainer management, attendance reports.
- **Architecture**:
  - Client Layer: Browser-based interface (HTML, CSS, JavaScript).
  - Application Layer: PHP scripts handling logic and database queries.
  - Data Layer: MySQL database with optimized schema.

## Recommendations
1. **Security Enhancements**: Implement password hashing and HTTPS for secure data transmission.
2. **Feature Additions**:
   - Real-time video conferencing for remote training.
   - Notifications for cycle updates or registration confirmations.
3. **UI/UX Improvements**: Adopt a modern frontend framework (e.g., React) for enhanced interactivity.
4. **Scalability**: Support multi-user access and larger datasets with cloud hosting.

## Limitations
- **Current Scope**: Designed for CNI’s internal use; lacks multi-organization support.
- **Offline Access**: Requires internet connectivity for full functionality.
- **Basic UI**: Interface could benefit from modern design frameworks.

## Future Improvements
- Integrate APIs for third-party calendar syncing.
- Add analytics dashboards for training performance metrics.
- Support mobile apps for on-the-go access.
- Implement role-based access control for finer-grained permissions.

## Contributors
- **Mahdi TOUMI**: Lead developer, system design, and implementation.

## Acknowledgments
Developed during a one-month internship at the Centre National de l'Informatique (CNI) as part of the academic requirements at École Nationale d'Ingénieurs de Carthage (ENICarthage). Special thanks to Mohammed Ali SAADAOUI for supervision and the CNI team for their support.
