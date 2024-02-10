# Task Management System with Laravel, Vue.js, and Inertia.js

This project is a task management system built using Laravel, Vue.js, and Inertia.js. It provides a seamless and modern user experience for managing tasks efficiently.

## Features

- **Task CRUD Operations:** Users can create, read, update, and delete tasks.
- **Real-Time Updates:** Changes to tasks, including toggling completion status, are reflected instantly without the need to refresh the page.
- **User Authentication and Registration:** Secure authentication system for user management with options for new user registration.
- **Search Functionality:** Users can search through the task list with debounce functionality for smoother user experience.
- **Server-Side Pagination:** Improved performance with server-side pagination, allowing for efficient handling of large datasets.
- **Per-Page Selection:** Users can customize the number of tasks displayed per page for their convenience.
- **Inertia.js Integration:** All functionalities are implemented using Inertia.js without the need for additional API endpoints.

### Why Inertia.js?

Inertia.js provides a modern approach to building server-driven single-page apps (SPAs) without the complexity of managing API endpoints separately. Here's why it's advantageous and secure:

1. **Reduced Complexity:** With Inertia.js, you can build SPAs using server-side routing and controllers, eliminating the need for a separate API layer. This reduces development overhead and complexity.

2. **Security:** Inertia.js maintains the security benefits of traditional server-rendered applications. Since data is fetched directly from server-side routes and controllers, you don't expose your application's internal APIs to the client-side, reducing the risk of attacks like XSS or CSRF.

3. **Performance:** By leveraging server-side rendering and partial page reloads, Inertia.js helps maintain fast page load times and a snappy user experience.

4. **Developer Experience:** Inertia.js simplifies the development workflow by allowing developers to leverage their existing server-side skills and frameworks (like Laravel in this case) to build modern SPAs.

5. **SEO-Friendly:** Inertia.js applications are SEO-friendly out of the box since initial renderings are done on the server-side, ensuring that search engines can crawl and index your content effectively.

In summary, Inertia.js offers a secure, efficient, and developer-friendly approach to building modern web applications, making it an excellent choice for projects like this task management system.

## Technologies Used

- **Laravel:** A powerful PHP framework for building web applications.
- **Vue.js:** A progressive JavaScript framework for building user interfaces.
- **Inertia.js:** A modern JavaScript framework for building server-driven single-page apps.
- **Tailwind CSS:** A utility-first CSS framework for quickly building custom designs.
- **MySQL:** A popular open-source relational database management system.

## Installation

1. Clone the repository:

    ```bash
    git clone https://github.com/ElmaallemSalah/tasks.git
    ```

2. Navigate into the project directory:

    ```bash
    cd tasks
    ```

3. Install PHP dependencies:

    ```bash
    composer install
    ```
    OR
     ```bash
    composer update
    ```

4. Install JavaScript dependencies:

    ```bash
    npm install
    ```

5. Set up your environment variables by renaming `.env.example` to `.env` and configuring the database connection.

6. Generate an application key:

    ```bash
    php artisan key:generate
    ```

7. Migrate the database with seeders:

    ```bash
    php artisan migrate:fresh --seed
    ```

8. Run the Backend development server:

    ```bash
    php artisan serve
    ```
  
9. Run the Frontend development server:

   
      ```bash
    npm run dev
    ```

10. Visit `http://localhost:8000` in your web browser to view the application.

## Usage

1. Register for a new account or login with existing credentials.

   Email :admin@admin.com
   Password : password
2. Start managing your tasks by creating, updating, or deleting them.
3. Enjoy the real-time updates and seamless user experience provided by the application.

## Contributing

Contributions are welcome! If you find any issues or have suggestions for improvement, feel free to open an issue or submit a pull request.

## License

This project is licensed under the [MIT License](LICENSE).

## Acknowledgements

- Laravel: [https://laravel.com](https://laravel.com)
- Vue.js: [https://vuejs.org](https://vuejs.org)
- Inertia.js: [https://inertiajs.com](https://inertiajs.com)
- Tailwind CSS: [https://tailwindcss.com](https://tailwindcss.com)

---


