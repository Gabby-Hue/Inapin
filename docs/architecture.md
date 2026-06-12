# Inapin Architecture Foundation

Inapin is a Laravel 12 application for Indonesian domestic travel discovery. Users search flights and ferries, then discover accommodation at the destination. Accommodation is the primary business domain.

## Recommended Folder Structure

```text
app/
├── Enums/
│   ├── BookingStatus.php
│   ├── PartnerStatus.php
│   ├── PropertyStatus.php
│   └── UserRole.php
├── Models/
│   ├── Airport.php
│   ├── Booking.php
│   ├── Favorite.php
│   ├── Ferry.php
│   ├── Flight.php
│   ├── Partner.php
│   ├── Port.php
│   ├── Property.php
│   ├── PropertyImage.php
│   ├── Review.php
│   └── User.php
└── Services/
    ├── Booking/
    │   └── BookingPriceCalculator.php
    ├── Property/
    │   ├── PropertyDiscoveryService.php
    │   └── PropertySearchCriteria.php
    └── Travel/
        └── DestinationAccommodationService.php

database/
├── factories/
├── migrations/
└── seeders/
```

## Database Schema

### users
- `id` primary key
- `name`
- `email` unique
- `email_verified_at` nullable
- `password`
- `role` enum: `user`, `partner`, `admin`
- `phone` nullable
- `remember_token`
- timestamps

### partners
- `id` primary key
- `user_id` unique foreign key to `users.id`, cascades on delete
- `business_name`
- `business_description` nullable
- `status` enum: `pending`, `approved`, `rejected`
- `contact_phone` nullable
- `tax_identification_number` nullable unique
- `address` nullable
- `city`, `province`
- timestamps

### properties
- `id` primary key
- `partner_id` foreign key to `partners.id`, cascades on delete
- identity fields: `name`, unique `slug`, `description`, `category`
- location fields: `city`, `province`, `address`, nullable `latitude`, nullable `longitude`
- commercial fields: `price_per_night`, `capacity`, `bedroom_count`, `bathroom_count`, JSON `facilities`
- `status` enum: `pending`, `approved`, `rejected`
- timestamps

### property_images
- `id` primary key
- `property_id` foreign key to `properties.id`, cascades on delete
- `image_path`, nullable `alt_text`, `sort_order`, `is_primary`
- timestamps

### bookings
- `id` primary key
- `property_id` foreign key to `properties.id`, cascades on delete
- `user_id` foreign key to `users.id`, cascades on delete
- `check_in`, `check_out`, `guest_count`, `total_price`
- `status` enum: `pending`, `confirmed`, `completed`, `cancelled`
- guest contact fields: `guest_name`, nullable `guest_phone`, nullable `special_requests`
- timestamps

### reviews
- `id` primary key
- `booking_id` unique foreign key to `bookings.id`, cascades on delete
- `property_id` foreign key to `properties.id`, cascades on delete
- `user_id` foreign key to `users.id`, cascades on delete
- `rating`, nullable `comment`
- timestamps

### favorites
- `id` primary key
- `user_id` foreign key to `users.id`, cascades on delete
- `property_id` foreign key to `properties.id`, cascades on delete
- `created_at`
- unique composite key on `user_id` and `property_id`

### airports and flights
- Airports store `name`, `city`, `province`, and unique three-letter `code`.
- Flights store `airline`, nullable `flight_number`, route foreign keys to airports, departure/arrival times, and `price`.

### ports and ferries
- Ports store `name`, `city`, `province`, and unique local `code`.
- Ferries store `operator`, nullable `vessel_name`, route foreign keys to ports, departure/arrival times, and `price`.

## Relationship Explanation

- A `User` can have one `Partner` profile, many `Booking` records, many `Review` records, many `Favorite` records, and many favorite properties through the `favorites` pivot table.
- A `Partner` belongs to one `User` and owns many `Property` records.
- A `Property` belongs to one `Partner`, has many `PropertyImage`, `Booking`, `Review`, and `Favorite` records, and is favorited by many users through `favorites`.
- A `Booking` belongs to one `User` and one `Property`; a booking can have one `Review`.
- A `Review` belongs to a booking, property, and user; `booking_id` is unique to enforce one review per completed stay.
- An `Airport` has outbound and inbound `Flight` records.
- A `Flight` belongs to an origin airport and a destination airport.
- A `Port` has outbound and inbound `Ferry` records.
- A `Ferry` belongs to an origin port and a destination port.

## ERD

```mermaid
erDiagram
    USERS ||--o| PARTNERS : "has profile"
    PARTNERS ||--o{ PROPERTIES : owns
    PROPERTIES ||--o{ PROPERTY_IMAGES : has
    USERS ||--o{ BOOKINGS : creates
    PROPERTIES ||--o{ BOOKINGS : receives
    BOOKINGS ||--o| REVIEWS : reviewed_by
    USERS ||--o{ REVIEWS : writes
    PROPERTIES ||--o{ REVIEWS : receives
    USERS ||--o{ FAVORITES : saves
    PROPERTIES ||--o{ FAVORITES : saved_as
    AIRPORTS ||--o{ FLIGHTS : origin
    AIRPORTS ||--o{ FLIGHTS : destination
    PORTS ||--o{ FERRIES : origin
    PORTS ||--o{ FERRIES : destination

    USERS {
        bigint id PK
        string name
        string email UK
        enum role
        string phone
    }
    PARTNERS {
        bigint id PK
        bigint user_id FK
        string business_name
        enum status
        string city
        string province
    }
    PROPERTIES {
        bigint id PK
        bigint partner_id FK
        string slug UK
        string category
        string city
        integer price_per_night
        enum status
    }
    PROPERTY_IMAGES {
        bigint id PK
        bigint property_id FK
        string image_path
        boolean is_primary
    }
    BOOKINGS {
        bigint id PK
        bigint property_id FK
        bigint user_id FK
        date check_in
        date check_out
        enum status
    }
    REVIEWS {
        bigint id PK
        bigint booking_id FK_UK
        bigint property_id FK
        bigint user_id FK
        tinyint rating
    }
    FAVORITES {
        bigint id PK
        bigint user_id FK
        bigint property_id FK
    }
    AIRPORTS {
        bigint id PK
        string code UK
        string city
    }
    FLIGHTS {
        bigint id PK
        bigint origin_airport_id FK
        bigint destination_airport_id FK
        datetime departure_time
    }
    PORTS {
        bigint id PK
        string code UK
        string city
    }
    FERRIES {
        bigint id PK
        bigint origin_port_id FK
        bigint destination_port_id FK
        datetime departure_time
    }
```
