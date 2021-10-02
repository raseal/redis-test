# Installation
Run `make build` in order to install all application dependencies (you must have Docker installed).

For more commands, type `make help`

# Purpose
Use Redis as temporary persistence layer via the `Predis` library.

This application use `Redis Insight` as a Redis client accessible via http://lcoalhost:8001

# Usage
This application exposes two endpoints ("search" and "create"):
| Endpoint      | Verb | Descriptions                                                           |
|---------------|------|------------------------------------------------------------------------|
| items/{id}    | GET  | Find the item whose `id` matches with the requested identifier         |
| items/        | POST | Create one item with the `id` and `name` specified in the request body |

## Request examples
Go to the `{PROJECT_FOLDER}/etc/endpoints/test_case_api.http` file to find some prepared requests.
