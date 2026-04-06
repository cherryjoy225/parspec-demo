# Parspec SQL Injection & WAF Demo

## Overview
This project demonstrates a vulnerable web application exposed to SQL Injection and its mitigation using ModSecurity WAF.

## Architecture
User → AWS EC2 → Apache → ModSecurity → PHP → MySQL

## Setup Steps
1. Created EC2 instance (Amazon Linux)
2. Installed Apache, PHP, MariaDB
3. Developed vulnerable login application (page1.php)
4. Configured ModSecurity WAF
5. Created protected version (page2.php)

## Vulnerability Demonstration
Input:
' OR '1'='1

Result:
Authentication bypass (admin access)

## WAF Protection
ModSecurity blocks SQL Injection patterns.

Protected page:
page2.php returns 403 Forbidden for malicious input

## URLs
Vulnerable:
http://3.27.11.164/page1.php

Protected:
http://3.27.11.164/page2.php

## Security Practices
- SSH restricted to specific IP
- Database not exposed externally
- Credentials managed using environment variables
- No secrets stored in source code

## Limitations
- Regex-based WAF rules (can be bypassed)
- No prepared statements used (intentional for demo)

## Conclusion
This project demonstrates how application vulnerabilities can be exploited and how WAF can provide an additional layer of protection.
