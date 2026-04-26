# Admin Panel Complete Implementation Guide

## Overview
This document describes the complete admin panel system that has been implemented for managing courses, FAQs, enrollments, contact page, and settings.

## Features Implemented

### 1. Courses Management
**Location:** Admin Panel > Courses

**Features:**
- Add new courses with:
  - Title
  - Short Description (for card display)
  - Full Description (rich text editor)
  - Course Content (rich text editor)
  - Course Image
  - Duration
  - Price
  - Level (Beginner, Intermediate, Advanced)
  - Active/Inactive status
  - SEO Meta Title & Description
- Edit existing courses
- Delete courses (single or bulk)
- View course details

**Routes:**
- `GET /admin/courses` - List all courses
- `GET /admin/courses/create` - Create new course form
- `POST /admin/courses` - Store new course
- `GET /admin/courses/{course}/edit` - Edit course form
- `PUT /admin/courses/{course}` - Update course
- `DELETE /admin/courses/{course}` - Delete course

### 2. FAQs Management
**Location:** Admin Panel > FAQs

**Features:**
- Add new FAQs with:
  - Question
  - Answer (rich text editor)
  - Display Order
  - Active/Inactive status
- Edit existing FAQs
- Delete FAQs
- Reorder FAQs

**Routes:**
- `GET /admin/faqs` - List all FAQs
- `GET /admin/faqs/create` - Create new FAQ form
- `POST /admin/faqs` - Store new FAQ
- `GET /admin/faqs/{faq}/edit` - Edit FAQ form
- `PUT /admin/faqs/{faq}` - Update FAQ
- `DELETE /admin/faqs/{faq}` - Delete FAQ

### 3. Enrollments Management
**Location:** Admin Panel > Enrollments

**Features:**
- View all course enrollments
- Filter by status (Pending, Approved, Rejected)
- Filter by course
- View enrollment details including:
  - Applicant name, email, phone
  - Course information
  - Message (if provided)
  - Submission date
- Update enrollment status (Approve/Reject/Pending)
- Delete enrollments
- Dashboard stats showing:
  - Pending count
  - Approved count
  - Rejected count
  - Total enrollments

**Routes:**
- `GET /admin/enrollments` - List all enrollments
- `GET /admin/enrollments/{enrollment}` - View enrollment details
- `PATCH /admin/enrollments/{enrollment}/status` - Update status
- `DELETE /admin/enrollments/{enrollment}` - Delete enrollment

### 4. Contact Page Management
**Location:** Admin Panel > Contact Page

**Features:**
- Manage contact page content:
  - Page Title
  - Page Description
  - Contact Email
  - Contact Phone
  - Contact Address
  - Google Map Embed Code
- Toggle display options:
  - Show/Hide Contact Information
  - Show/Hide Contact Form
  - Show/Hide Google Map

**Routes:**
- `GET /admin/contact` - Contact page settings form
- `POST /admin/contact` - Update contact settings

### 5. Settings Management
**Location:** Admin Panel > Settings

**Features:**

#### General Settings
- Site Name
- Site Tagline
- Site Description
- Site Keywords
- Logo Upload
- Favicon Upload
- Primary Color
- Secondary Color
- Header Background Color
- Footer Description
- Social Media Links (Facebook, Twitter, LinkedIn)
- Contact Information (Email, Phone, Address)

#### Admin Profile
- Update Username
- Update Email
- Update Password (with confirmation)

#### Change Password
- Current Password verification
- New Password (min 8 characters)
- Password Confirmation

**Routes:**
- `GET /admin/settings` - Settings page
- `POST /admin/settings` - Update general settings
- `GET /admin/settings/profile` - Profile settings
- `POST /admin/settings/profile` - Update profile
- `GET /admin/settings/password` - Password change form
- `POST /admin/settings/password` - Update password

### 6. Frontend Course Enrollment
**Location:** Frontend > Courses Page

**Features:**
- Display courses in card format with:
  - Course Image
  - Title
  - Short Description
  - Price
  - Duration
  - Level Badge
  - "Enroll Now" Button
- Enrollment Modal Popup with form:
  - Full Name
  - Email Address
  - Phone Number
  - Message (optional)
- Success Alert after submission with message:
  - "Your enrollment has been submitted successfully! Please wait for admin approval. We will contact you soon."

**Routes:**
- `GET /courses` - View all courses
- `POST /courses/{slug}/enroll` - Submit enrollment

## Database Schema

### Courses Table
- id
- title
- slug (auto-generated)
- short_description (NEW)
- description
- content
- image
- duration
- price
- level
- curriculum (JSON)
- is_active
- views
- meta_title
- meta_description
- created_at
- updated_at

### Enrollments Table
- id
- name
- email
- phone
- course_id (foreign key)
- message
- status (pending, approved, rejected)
- created_at
- updated_at

### FAQs Table
- id
- question
- answer
- order
- is_active
- created_at
- updated_at

### Settings Table
- id
- key
- value
- type
- group
- created_at
- updated_at

## How to Use

### Adding a New Course
1. Login to admin panel (`/admin/login`)
2. Click on "Courses" in the sidebar
3. Click "Add New Course" button
4. Fill in all course details
5. Upload course image
6. Set course as Active if ready to display
7. Click "Save Course"

### Managing Enrollments
1. Click on "Enrollments" in the sidebar
2. View list of all enrollments
3. Use filters to find specific enrollments
4. Click on an enrollment to view details
5. Change status using the dropdown (Pending/Approved/Rejected)
6. Click "Update Status" to save

### Managing FAQs
1. Click on "FAQs" in the sidebar
2. Click "Add New FAQ" button
3. Enter question and answer
4. Set display order (lower numbers appear first)
5. Set as Active if ready to display
6. Click "Save FAQ"

### Managing Contact Page
1. Click on "Contact Page" in the sidebar
2. Update contact information
3. Paste Google Map embed code (optional)
4. Toggle display options as needed
5. Click "Save Contact Settings"

### Changing Admin Credentials
1. Click on "Settings" in the sidebar
2. Go to "Admin Profile" tab
3. Update username and email
4. Enter current password for verification
5. Optionally set new password
6. Click "Update Profile"

## Frontend Integration

The course cards on the frontend automatically display:
- Course image (or placeholder if no image)
- Course title
- Level badge
- Price
- Duration
- Short description (or truncated full description)
- "Enroll Now" button

When a user clicks "Enroll Now":
1. Modal popup appears with enrollment form
2. User fills in their details
3. Form is submitted via AJAX
4. Success alert shows: "Your enrollment has been submitted successfully! Please wait for admin approval. We will contact you soon."
5. Admin can then view, approve, or reject the enrollment from the admin panel

## Technical Notes

- All admin routes are protected by authentication middleware
- Images are stored in `storage/app/public/` and accessible via `storage/` symlink
- Rich text editing is provided by Summernote
- All forms include CSRF protection
- Enrollment status defaults to "pending"
- Settings are cached for performance
- Cache is cleared when settings are updated