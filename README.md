# 🛒 CHL SmartSolution - API and Web Routes Documentation

## 🌐 Base URL

```
http://webproject.test
```

---

## 📚 Full Route List

| #   | Route            | Method | Name         | Authentication | Description                 |
| --- | ---------------- | ------ | ------------ | -------------- | --------------------------- |
| 1   | `/`              | GET    | `home`       | Optional       | View homepage with products |
| 2   | `/signin`        | GET    | `signin`     | No             | View login page             |
| 3   | `/signin`        | POST   | —            | No             | Authenticate user           |
| 4   | `/signup`        | GET    | `signup`     | No             | View signup page            |
| 5   | `/signup`        | POST   | —            | No             | Register new user           |
| 6   | `/signout`       | POST   | `signout`    | Yes            | Logout user                 |
| 7   | `/cart`          | GET    | `cart`       | Yes            | View user's cart page       |
| 8   | `/products/{id}` | GET    | —            | No             | View a specific product     |
| 9   | `/help-center`   | GET    | `helpCenter` | Optional       | View help center page       |
| 10  | `/help-request`  | POST   | —            | Yes            | Submit a help request       |
| 11  | `/checkout`      | POST   | —            | Yes            | Place an order (checkout)   |

---

## 🛠️ Detailed Route Descriptions

### `/` (GET)

- **Name:** `home`
- **Authentication:** Optional
- **Status Code:** `200 OK`
- **Description:** Display homepage with paginated product list.

---

### `/signin` (GET)

- **Name:** `signin`
- **Authentication:** No
- **Status Code:** `200 OK`
- **Description:** Display user login page.

---

### `/signin` (POST)

- **Authentication:** No
- **Status Code:** `303 See Other` (on success) / `422 Unprocessable Entity` (validation failed)
- **Description:** Authenticate a user.

**Request:**

```json
{
  "email": "user@example.com",
  "password": "password123"
}
```

---

### `/signup` (GET)

- **Name:** `signup`
- **Authentication:** No
- **Status Code:** `200 OK`
- **Description:** Display user registration page.

---

### `/signup` (POST)

- **Authentication:** No
- **Status Code:** `303 See Other` (on success) / `422 Unprocessable Entity` (validation failed)
- **Description:** Register a new user.

**Request:**

```json
{
  "name": "John Doe",
  "email": "user@example.com",
  "password": "password123"
}
```

---

### `/signout` (POST)

- **Name:** `signout`
- **Authentication:** Yes
- **Status Code:** `200 OK`
- **Description:** Logout the authenticated user.

**Response:**

```json
{
  "message": "Successfully logged out."
}
```

---

### `/cart` (GET)

- **Name:** `cart`
- **Authentication:** Yes
- **Status Code:** `200 OK`
- **Description:** Display the user's shopping cart page.

---

### `/products/{id}` (GET)

- **Authentication:** No
- **Status Code:** `200 OK` / `404 Not Found`
- **Description:** View details of a specific product.

---

### `/help-center` (GET)

- **Name:** `helpCenter`
- **Authentication:** Optional
- **Status Code:** `200 OK`
- **Description:** Display help center page.

---

### `/help-request` (POST)

- **Authentication:** Yes
- **Status Code:** `201 Created` / `422 Unprocessable Entity`
- **Description:** Submit a new help request.

**Request:**

```json
{
  "subject": "Delivery Issue",
  "address": "123 Street Name, City",
  "message": "My order hasn't arrived yet."
}
```

---

### `/checkout` (POST)

- **Authentication:** Yes
- **Status Code:** `201 Created` / `422 Unprocessable Entity`
- **Description:** Submit a new order from the shopping cart.

**Request:**

```json
{
  "cart_items": "[{\"id\":1,\"quantity\":2}]",
  "subtotal": 500,
  "shipping": 50,
  "tax": 25,
  "total": 575
}
```

**Response:**

```json
{
  "message": "Your order has been placed successfully."
}
```

---

# 📢 Notes

- Flash messages are used for user feedback.
- `sweetalert()` notifications are used on success/error.
- Validation errors return status code `422` with a corresponding message.
- User must be authenticated to access checkout, cart, help-request, and signout endpoints.
- Products can be viewed without logging in.
