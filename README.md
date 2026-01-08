# Job Candidates Management System

A Laravel-based application for managing job candidates, featuring a modern, responsive user interface built with Tailwind CSS.

## Features

- **Dashboard Overview**: View all candidates in a beautifully designed, responsive list with gradient themes.
- **Candidate Profiles**: Clickable ID buttons to view detailed candidate profiles in a card layout.
- **Edit Functionality**: Easy-to-use edit forms with dynamic fields for previous experience.
- **Modern UI/UX**: 
  - Premium Indigo-Purple-Pink gradient theme.
  - Smooth animations and transitions.
  - Mobile-responsive design.
  - Interactive hover effects.

## Setup Instructions

### Prerequisites
- PHP >= 8.1
- Composer
- Node.js & NPM
- MySQL (via XAMPP or standalone)

### Installation

1.  **Clone the repository** (if not already present):
    ```bash
    git clone <repository-url>
    ```

2.  **Install PHP Dependencies**:
    ```bash
    composer install
    ```

3.  **Install Frontend Dependencies**:
    ```bash
    npm install
    ```

4.  **Environment Setup**:
    - Copy `.env.example` to `.env` if it doesn't exist.
    - Configure your database credentials in `.env`:
      ```env
      DB_DATABASE=job_candidates_db
      DB_USERNAME=root
      DB_PASSWORD=
      ```

5.  **Run Migrations**:
    ```bash
    php artisan migrate
    ```

### Running Locally

1.  **Start the Development Server**:
    ```bash
    php artisan serve
    ```

2.  **Compile Assets**:
    In a separate terminal, run:
    ```bash
    npm run dev
    ```

3.  **Access the Application**:
    Open [http://localhost:8000/all_candidates](http://localhost:8000/all_candidates) in your browser.

## Design Choices

### Technology Stack
-   **Framework**: Laravel 10+
-   **Styling**: Tailwind CSS (via Vite)
-   **Templating**: Blade

### UI/UX Decisions
-   **Gradient Theme**: Adopted a unified `from-indigo-50 via-purple-50 to-pink-50` background to create a modern, premium feel across all pages.
-   **Card-Based Layout**: Used detailed card layouts for the "Show" and "Edit" views to group information logically and improve readability.
-   **Interactive Elements**: 
    -   **Clickable IDs**: Transformed candidate IDs into interactive, rounded buttons that instinctively lead users to the detailed profile view.
    -   **Dynamic Forms**: Implemented JavaScript-based dynamic fields for "Previous Experience" to handle variable amounts of data without cluttering the UI.
-   **Navigation**: Improved navigation flow with clear "Back" links and prominent action buttons.

## Project Structure

-   `resources/views/all_candidates.blade.php`: The main dashboard view.
-   `resources/views/show.blade.php`: Detailed candidate profile view.
-   `resources/views/edit.blade.php`: Candidate editing form.
-   `app/Http/Controllers/AllCandidatesController.php`: Handles core logic (Index, Show, Edit, Update, Delete).
