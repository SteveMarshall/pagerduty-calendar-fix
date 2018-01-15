**This repository is deprecated in favour of [the new Ruby
version](https://github.com/SteveMarshall/pagerduty-calendar-fixer)**


`pagerduty-fix`
===============

A little script to fiddle with [PagerDuty](https://www.pagerduty.com)'s on-call calendars so that a daily rota shows up as all-day events instead of for the exact hours. You probably only want this is your rota is pretty standard from day to day.

Requirements
------------

- A server running some version of PHP
- [Martin Thoma's ics-parser](https://github.com/MartinThoma/ics-parser) (included)
- A PagerDuty account

Getting started
---------------

1. Get the URL to your iCalendar file from your PagerDuty profile
2. Upload the contents of this folder to your server somewhere
3. Subscribe to http://your-server.org/path/to/these/files/?feed=[your-calendar-url]
