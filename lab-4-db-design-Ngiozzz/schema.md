# Doctor Verification Database Schema – Suggestions
---

## 1. Practitioner Enhancements

* Added `profile_photo_url` for doctor profile images.
* Removed redundant `date_of_first_registration`.
* Linked practitioners to **contacts**, **licenses**, and **practitioner_documents** tables.

---

## 2. Contact Information Normalization

* New **`contacts` table** to store multiple practitioner contact points (phone, email, WhatsApp, etc.) with support for `is_primary`.

---

## 3. Specialities & Sub-Specialities

* **Renamed tables**:

  * `categories` → `specialities`
  * `sub_categories` → `sub_specialities`
* Updated all foreign keys accordingly.

---

## 4. License Management

* New **`licenses` table** for license number, issue date, expiry date, and status.
* New **`payments` table** for tracking license renewal payments.

---

## 5. Practitioner Documents

* New **`practitioner_documents` table** for degree certificates, licenses, IDs, and other supporting documents.

---

## 6. User & Role Management

* Introduced a dedicated **`roles` table** instead of ENUM for flexible role assignment.
* `users.role_id` now references `roles.id`.

---

## 7. Security & Logging

* Improved **verification_logs**: added `practitioner_id` FK for better referential integrity.
* Retained `data_sync_logs` for system-level synchronization traceability.

---

## 8. General Improvements

* Enforced **consistent singular naming**.
* Reduced redundancy and improved normalization.
* Added extensibility for future fields (e.g., audit, compliance).

---

## 🙏 Thank You for your feedback :)

Your suggestions were crucial in identifying gaps and prioritizing improvements.
Here is a breakdown of the **recurring themes** you raised, grouped by category:

| Theme                        | Frequency |
| ---------------------------- | --------- |
| Contacts normalization       | 23        |
| Normalization/schema cleanup | 20        |
| Workplace/location           | 17        |
| Audit trail/logs             | 17        |
| License tracking             | 13        |
| Years of experience          | 10        |
| Personal details             | 10        |
| Security (hashing/passwords) | 8         |
| Role/permissions             | 7         |
| Doctor rating/reviews        | 4         |


## Updated Schema
```mermaid
erDiagram

    %% Core practitioner entity
    practitioners ||--|| statuses : has
    practitioners ||--|| specialities : belongs_to
    practitioners }o--|| sub_specialities : may_specialize_in
    practitioners ||--o{ qualifications : holds
    practitioners ||--o{ contacts : has
    practitioners ||--o{ licenses : issued
    practitioners ||--o{ practitioner_documents : uploads

    %% Qualification breakdown
    qualifications }|--|| degrees : is_type
    qualifications }|--|| institutions : awarded_by

    %% Sub-speciality hierarchy
    sub_specialities }|--|| specialities : under

    %% Licenses & renewals
    licenses ||--o{ payments : renewed_via

    %% Admin users
    users ||--|| roles : assigned_role

    %% Audit & operational tables
    verification_logs }o--|| practitioners : attempts_to_verify 

    %% Table definitions
    practitioners {
        BIGINT id PK
        VARCHAR registration_number UK
        VARCHAR full_name
        VARCHAR profile_photo_url "nullable"
        BIGINT status_id FK
        BIGINT speciality_id FK
        BIGINT sub_speciality_id FK "nullable"
        DATE date_of_registration "nullable"
        TIMESTAMP created_at
        TIMESTAMP updated_at
    }

    contacts {
        BIGINT id PK
        BIGINT practitioner_id FK
        VARCHAR type "e.g. email, phone, whatsapp"
        VARCHAR value
        BOOLEAN is_primary
    }

    statuses {
        BIGINT id PK
        VARCHAR name UK
        TEXT description "nullable"
    }

    specialities {
        BIGINT id PK
        VARCHAR name UK
    }

    sub_specialities {
        BIGINT id PK
        VARCHAR name
        BIGINT speciality_id FK
    }

    qualifications {
        BIGINT id PK
        BIGINT practitioner_id FK
        BIGINT degree_id FK
        BIGINT institution_id FK
        VARCHAR specialization "nullable"
        SMALLINT year_awarded "nullable"
        TEXT notes "nullable"
    }

    degrees {
        BIGINT id PK
        VARCHAR name UK
        TEXT description "nullable"
    }

    institutions {
        BIGINT id PK
        VARCHAR name UK
    }

    licenses {
        BIGINT id PK
        BIGINT practitioner_id FK
        VARCHAR license_number UK
        DATE issue_date
        DATE expiry_date
        VARCHAR status "active/suspended/expired"
    }

    payments {
        BIGINT id PK
        BIGINT license_id FK
        DECIMAL amount
        DATE payment_date
        VARCHAR method "e.g. mpesa, card"
        VARCHAR status "pending/confirmed"
    }

    practitioner_documents {
        BIGINT id PK
        BIGINT practitioner_id FK
        VARCHAR document_type "degree, certificate, id, license"
        VARCHAR file_path
        DATE uploaded_at
    }

    verification_logs {
        BIGINT id PK
        BIGINT practitioner_id FK
        VARCHAR ip_address "nullable"
        TEXT user_agent "nullable"
        BOOLEAN is_valid
        TIMESTAMP verified_at
    }

    data_sync_logs {
        BIGINT id PK
        INT records_processed
        VARCHAR source_url
        TIMESTAMP synced_at
        TEXT errors "nullable"
    }

    users {
        BIGINT id PK
        VARCHAR name
        VARCHAR email UK
        TIMESTAMP email_verified_at "nullable"
        TEXT password
        BIGINT role_id FK
        VARCHAR remember_token "nullable"
        TIMESTAMP created_at
        TIMESTAMP updated_at
    }

    roles {
        BIGINT id PK
        VARCHAR name UK
        TEXT description "nullable"
    }
```
> "In God we Trust, all others bring data!" - W. Edwards Deming