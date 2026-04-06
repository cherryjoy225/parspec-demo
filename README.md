# Parspec SQL Injection & WAF Demo

## Overview

This project demonstrates a vulnerable web application exposed to SQL Injection and its mitigation using ModSecurity WAF. The application is deployed on AWS EC2 (Amazon Linux) using Apache, PHP, and MariaDB.

---

## Architecture

User → EC2 → Apache → ModSecurity → PHP → MySQL

---

## Setup Steps

1. Created an EC2 instance (Amazon Linux)
2. Configured Security Groups:

   * HTTP (80) open to public
   * SSH (22) restricted to my IP
3. Installed Apache (httpd), PHP, and MariaDB
4. Created a test database and users
5. Developed a vulnerable login application (`page1.php`)
6. Configured environment variables for database credentials
7. Installed and configured ModSecurity WAF
8. Created a protected version of the application (`page2.php`)

---

## Application Flow

* User accesses login page (`page1.php`)
* Inputs are sent to backend PHP
* SQL query is executed directly without sanitization
* If valid or injected input is used, user is authenticated
* On success, user is redirected to `dashboard.php`
* Dashboard shows role (admin or normal user)
* Logout redirects back to login page

---

## Vulnerability Demonstration

### SQL Injection Payload:

' OR '1'='1

### Result:

* Authentication bypass
* Logged in as admin without valid credentials

---

## WAF Protection

ModSecurity WAF is configured with custom rules to detect SQL injection patterns.

### Behavior:

* `page1.php` → Vulnerable (SQL Injection works)
* `page2.php` → Protected (returns 403 Forbidden)

---

## URLs

### Vulnerable Endpoint:

http://3.27.11.164/page1.php

### Protected Endpoint:

http://3.27.11.164/page2.php

---

## Test Credentials

For demonstration purposes, a normal user credential is displayed in the UI:

Username: user1
Password: normal_user_123@#

This is intentionally exposed to allow functional testing.

Admin credentials are not exposed in the UI and can only be accessed via SQL injection or valid authentication.

---

## Security Practices

* SSH access restricted to specific IP
* Database is not publicly accessible
* Credentials are managed using environment variables (Apache SetEnv)
* No hardcoded secrets in application code
* Minimal attack surface via security groups
* IMDSv2 enforced for EC2 metadata security

---

## Security Considerations

* SQL Injection vulnerability is intentionally introduced for demonstration
* WAF protection is rule-based and may be bypassed in advanced scenarios
* Application does not use prepared statements (intentional for demo)
* Environment variables are used instead of hardcoded credentials

---

## Limitations

* Basic regex-based WAF rules
* No rate limiting or advanced protections
* Not production hardened (for demo purposes only)

---

## Conclusion

This project demonstrates how SQL Injection vulnerabilities can be exploited and how a Web Application Firewall (ModSecurity) can mitigate such attacks at the web server level. It highlights the importance of defense-in-depth, combining secure coding practices with infrastructure-level protections.
