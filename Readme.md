Tricycle Tax Management & Revenue Tracking System (TTRTS)

 PROJECT OVERVIEW
A centralized web-based platform designed for state-wide management of tricycle (Keke) tax collection, enabling:
    • Digital registration of tricycles
    • Unique ID generation tied to plate numbers
    • Real-time tax payment validation by field agents
    • Multi-level administrative monitoring (Unit → LGA → State)
    • Transparent revenue tracking and reporting
This system eliminates leakages, fraud, and manual inefficiencies in tax collection.

SYSTEM STRUCTURE (HIGH LEVEL)
The system follows a multi-tenant hierarchical architecture:
STATE ADMIN
   ↓
LGA ADMIN (21 LGAs)
   ↓
UNIT ADMIN (multiple per LGA)
   ↓
FIELD AGENTS (Collectors)
   ↓
TRICYCLE OWNERS

USER ROLES & PERMISSIONS
1.  Super Admin (State Level)
    • Full system control
    • Create/manage LGAs
    • View ALL transactions across the state
    • Assign LGA admins
    • Generate state-wide reports
    • Audit activities

2. LGA Admin
    • Manage units within their LGA
    • Register tricycles (optional: shared with unit admins)
    • Assign unit admins & agents
    • View transactions within their LGA
    • Generate LGA-level reports

3. Unit Admin
    • Register tricycles within their unit
    • Manage agents
    • View unit-specific transactions
    • Monitor daily collections

4.  Field Agents (Collectors)
    • Input tricycle ID / plate number
    • Fetch owner details instantly
    • Record payments (daily/weekly/monthly)
    • Issue digital receipt

5. Tricycle Owner (Optional future feature)
    • View payment history
    • Receive digital receipts (SMS/email/app)

 CORE FEATURES
1.  Tricycle Registration Module
    • Done by Admin (Unit/LGA/State depending on config)
    • Capture:
        ◦ Owner Name
        ◦ Phone Number
        ◦ Address
        ◦ Plate Number
        ◦ Engine Number (optional)
        ◦ LGA
        ◦ Unit
        ◦ Passport photo (optional)
        ◦ AND OTHER DETAIL TO BE PROVIDED BY THE STATE ADMIN
 Output:
    • Auto-generated Unique ID
        ◦ Example: LAG-IKJ-UNIT03-000245
    • ID linked directly to plate number

2.  Verification System (Agent Interface)
    • Agent inputs:
        ◦ Plate Number OR Unique ID
System returns:
    • Owner details
    • Registration status
    • Payment status (Paid / Owing / Expired)
This ensures:
✔ No fake collections
✔ No duplicate payments
✔ Real-time validation

3.  Payment & Tax Collection Module
Supports:
    • Daily
    • Weekly
    • Monthly
Payment Methods:
    • Cash (recorded by agent)
    • Online payment
After payment:
    • Transaction recorded
    • Digital receipt generated
    • Timestamp + agent ID logged

4.  Transaction Monitoring Dashboard
Admin Views Based on Role:
Role
Scope
Unit Admin
Only their unit
LGA Admin
All units in LGA
State Admin
Entire state
Dashboard Metrics:
    • Total revenue
    • Daily collections
    • Active vs inactive tricycles
    • Payment trends
    • Top performing units


5.  Reporting System
    • Daily / Weekly / Monthly reports
    • Export (PDF, Excel)
    • Filters:
        ◦ By LGA
        ◦ By Unit
        ◦ By Date
        ◦ By Agent

6.  Role-Based Access Control (RBAC)
    • Strict permission hierarchy
    • Data isolation per level
    • Secure authentication (JWT / OAuth)

7.  Audit & Activity Logs
    • Track:
        ◦ Who registered what
        ◦ Who collected payment
        ◦ When transactions occurred
	Critical for:
	✔ Transparency
	✔ Anti-corruption
	✔ Dispute resolution

8.  Notifications (Optional but Powerful)
    • SMS to owners after payment
    • Alerts for expired taxes
    • Admin alerts for suspicious activity
