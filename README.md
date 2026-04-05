# Course Discovery System (WordPress)

## Overview

This project is a Course Discovery System built in WordPress as per the assignment requirements.
It allows users to search and filter courses using multiple criteria such as provider, location, start date, and category.

The system is designed with scalability, extensibility, and reusable filter logic in mind.

---

## Features

### Frontend

* Search courses using keyword (name, short description, long description)
* Filter courses by:

  * Provider (multi-select)
  * Location (multi-select)
  * Start Date (multi-select dropdown)
  * Category (multi-select)
* AJAX-based filtering (no page reload)
* Responsive layout

---

### Backend (WordPress Admin)

* Custom Post Types:

  * Courses
  * Providers
  * Instructors

* Taxonomy:

  * Course Categories (hierarchical)

* ACF (Advanced Custom Fields) used for:

  * Course Fields:

    * Short Description
    * Long Description
    * Price
    * Providers (relationship)
    * Instructors (relationship)
    * Start Date (text - comma separated)
  * Provider Fields:

    * Location

---

## Data Modeling

* Each course can have:

  * Multiple providers
  * Multiple instructors
  * Multiple start dates (stored as comma-separated values)
  * One or more categories

* Location is derived from provider (as per requirement)

---

## Filter Logic

* Top-level filters are combined using **AND**
* Multiple values within the same filter are combined using **OR**

### Example:

(provider = Oxford OR provider = DMU)
AND
(location = London OR location = Mumbai)
AND
(category = Science)

---

## Setup Instructions

### 1. Install WordPress

* Setup local environment (XAMPP / Localhost)
* Install WordPress

### 2. Add Theme Files

* Place project files inside `/wp-content/themes/your-theme/`

### 3. Activate Theme

* Go to Appearance → Themes → Activate

### 4. Install Plugin

* Install and activate:

  * Advanced Custom Fields (ACF)

### 5. Configure ACF Fields

#### Course Fields

* Short Description (Text Area)
* Long Description (Text Area)
* Price (Number)
* Providers (Relationship → Provider)
* Instructors (Relationship → Instructor)
* Start Date (Text → comma separated)

#### Provider Fields

* Location (Text)

---

### 6. Add Data

#### Providers

* Add providers with location

#### Courses

* Add courses with:

  * Price
  * Providers
  * Start Dates (comma separated)
  * Categories

---

## File Structure

* functions.php → Post types, AJAX, filter logic
* page.php → Frontend UI
* assets/js/app.js → AJAX filtering

---

## Testing

### What was tested:

* Search functionality
* Multi-filter combinations
* AND / OR logic
* Empty results handling

### Possible bugs:

* Incorrect data format (dates not comma separated)
* Missing provider selection
* Missing location in provider

### Prevent regression:

* Keep consistent field structure
* Validate input formats

---

## Performance & Scalability

### Potential bottlenecks:

* Meta queries in large datasets
* Multiple LIKE queries

### Improvements (future):

* Custom database tables
* Indexing
* Caching (transients)

---

## Conclusion

This implementation meets all assignment requirements including:

* Proper data modeling
* Reusable filter logic
* WordPress best practices
* Extensible architecture

---
