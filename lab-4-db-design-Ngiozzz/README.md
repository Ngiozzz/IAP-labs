[![Review Assignment Due Date](https://classroom.github.com/assets/deadline-readme-button-22041afd0340ce965d47ae6ef1cefeee28c7c493a6346c4f15d667ab976d596c.svg)](https://classroom.github.com/a/uTNBxOBQ)
# 🩺 Thibitisha - Doctor Verification

## 🗃️ Database Design

> **Purpose**: Verify if a doctor is legally registered with the **Kenya Medical Practitioners and Dentists Council (KMPDC)**.  
> **Admin Feature**: Admins can register/update practitioner **email** and **phone** for communication (e.g., license alerts).  
> **Data Source**: Core practitioner data synced from [KMPDC Register](https://kmpdc.go.ke/Registers/practitioners.php).

---

## 🔷 Relational Schema Diagram

```mermaid
erDiagram

    %% Core practitioner entity
    practitioners ||--|| statuses : "has"
    practitioners ||--|| categories : "belongs to"
    practitioners }o--|| sub_categories : "may specialize in"
    practitioners ||--o{ qualifications : "holds"

    %% Qualification breakdown
    qualifications }|--|| degrees : "is type"
    qualifications }|--|| institutions : "awarded by"

    %% Sub-category hierarchy
    sub_categories }|--|| categories : "under"

    %% Audit & operational tables (no FKs to core for flexibility)
    verification_logs }o--|| practitioners : "attempts to verify" 
    data_sync_logs

    %% Admin users
    users

    %% Table definitions with columns
    practitioners {
        BIGINT id PK
        VARCHAR(50) registration_number UK
        VARCHAR(255) full_name
        VARCHAR(255) email UK "nullable, admin-added"
        VARCHAR(20) phone "nullable, admin-added"
        BIGINT status_id FK
        BIGINT category_id FK
        BIGINT sub_category_id FK "nullable"
        DATE date_of_registration "nullable"
        DATE date_of_first_registration "nullable"
        TIMESTAMP created_at
        TIMESTAMP updated_at
    }

    statuses {
        BIGINT id PK
        VARCHAR(50) name UK
        TEXT description "nullable"
    }

    categories {
        BIGINT id PK
        VARCHAR(100) name UK
    }

    sub_categories {
        BIGINT id PK
        VARCHAR(150) name
        BIGINT category_id FK
    }

    qualifications {
        BIGINT id PK
        BIGINT practitioner_id FK
        BIGINT degree_id FK
        BIGINT institution_id FK
        VARCHAR(150) specialization "nullable"
        SMALLINT year_awarded "nullable"
        TEXT notes "nullable"
    }

    degrees {
        BIGINT id PK
        VARCHAR(100) name UK
        TEXT description "nullable"
    }

    institutions {
        BIGINT id PK
        VARCHAR(255) name UK
    }

    verification_logs {
        BIGINT id PK
        VARCHAR(50) registration_number
        VARCHAR(45) ip_address "nullable"
        TEXT user_agent "nullable"
        BOOLEAN is_valid
        TIMESTAMP verified_at
    }

    data_sync_logs {
        BIGINT id PK
        INT records_processed
        VARCHAR(255) source_url
        TIMESTAMP synced_at
        TEXT errors "nullable"
    }

    users {
        BIGINT id PK
        VARCHAR(255) name
        VARCHAR(255) email UK
        TIMESTAMP email_verified_at "nullable"
        VARCHAR(255) password
        ENUM role "admin/staff"
        VARCHAR(100) remember_token "nullable"
        TIMESTAMP created_at
        TIMESTAMP updated_at
    }
```

---

## 📚 Table Descriptions (For Learning)

### 1. `practitioners`
- **Core entity** for every KMPDC-registered doctor/dentist.
- **Foreign keys**:
  - `status_id` → `statuses.id` ✅
  - `category_id` → `categories.id`
  - `sub_category_id` → `sub_categories.id`

### 2. `statuses`
- Lookup table for registration status: `"Active"`, `"Suspended"`, `"Deceased"`, etc.

### 3. `categories` & `sub_categories`
- `categories`: Broad roles (`"Medical Officer"`, `"Dentist"`).
- `sub_categories`: Specializations (`"Paediatrics"`, `"Oral Surgery"`), linked to a `category`.

### 4. `degrees`, `institutions`, `qualifications`
- Normalized rich qualification data into structured, searchable records.
- Example: `"MMed (Surgery – UoN, 2015)"` → broken into degree, institution, specialization, year.

### 5. `verification_logs`
- Logs all verification attempts (valid or invalid).
- `registration_number` is **not a foreign key** (to allow logging of fake/typo attempts).

### 6. `data_sync_logs`
- Tracks KMPDC data ingestion (scraping or manual import).

### 7. `users`
- Admin/staff accounts with `role` (`admin`/`staff`).

---