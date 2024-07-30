# Task Manager

## Description

Task Manager is an application that allows its users to have control of the activities they wanna develop.
The app allows for the creation, listing, updating and deleting of tasks.

## How to use it

Task Manager can be used both through api routes following the instructions below:

1. Install the app using GitHub
    
2. Run the server using ```php artisan serve```

3. Consume the API through your app of choice. Ex.: Insomnia, Postman

## Interaction with the app

### Registering

#### Request

- HTTP Method: POST
- Route: localhost:8000/register
- Body format:
{
    "name" : string,
    "email" : string,
    "password" : string
}
- Body example:
{
    "name" : "Jonas Dorival",
    "email" : "jonas.dorival@email.com",
    "password" : "braSil1sH0m3!"
}

#### Response
- Response Status Codes:
    - 200 OK
    - 422 Unprocessable Content
- Response type: json object
- Reponse Body (200 OK):
{
	"id": "9ca446c6-4fbc-462b-9b97-85a5afbb8a87",
	"name": "Jonas Dorival",
	"email": "jonas.dorival@email.com"
}

### Authentication

#### Request

- HTTP Method: POST
- Route: localhost:8000/login
- Body format:
{
    "email" : string,
    "password" : string
}
- Body example:
{
    "email" : "jonas.dorival@email.com",
    "password" : "braSil1sH0m3!"
}

#### Response
- Response Status Codes:
    - 200 OK
    - 422 Unprocessable Content
- Response type: json object
- Reponse Body (200 OK):
{
	"message": "Authenticated",
	"token": "1|YQSlSFQItiwM9IJzwkylVJWXB26kTrwhT3yKfn2R10ceb4be"
}

### Creating Tasks

#### Request

- HTTP Method: POST
- Route: localhost:8000/tasks
- Authentication: Bearer Token - "token" attribute from Authentication route
- Body format:
{
    "description" : string
}
- Body example:
{
    "description" : "wash the dishes"
}

#### Response

- Response Status Codes:
    - 201 Created
    - 401 Unauthorized
    - 422 Unprocessable Content
- Response type: json object
- Reponse Body (200 OK):
{
    "id": "9ca253bf-2cc9-4850-b966-7848f4aee3b9",
    "description": "buy a phone",
    "completed": false,
    "created_at": "2024-07-28T23:40:36.000000Z",
    "updated_at": "2024-07-29T00:34:11.000000Z",
    "user_id": "9ca25386-59fd-4e6d-b8cb-a89b5537bd13"
}

### Listing Tasks

- HTTP Method: GET
- Route: localhost:8000/tasks
- Authentication: Bearer Token - "token" attribute from Authentication route
- Body format:
no body

#### Response

- Response Status Codes:
    - 200 OK
    - 401 Unauthorized
    - 422 Unprocessable Content
- Response type: Array
- Reponse Body (200 OK):
[
	{
		"id": "9ca253bf-2cc9-4850-b966-7848f4aee3b9",
		"description": "buy a phone",
		"completed": false,
		"created_at": "2024-07-28T23:40:36.000000Z",
		"updated_at": "2024-07-29T00:34:11.000000Z",
		"user_id": "9ca25386-59fd-4e6d-b8cb-a89b5537bd13"
	},
	{
		"id": "9ca25645-d9d7-42f7-9700-ac067e4219d4",
		"description": "wash dishes",
		"completed": false,
		"created_at": "2024-07-28T23:47:40.000000Z",
		"updated_at": "2024-07-28T23:47:40.000000Z",
		"user_id": "9ca25386-59fd-4e6d-b8cb-a89b5537bd13"
	}
]

### Updating Tasks

#### Request

- HTTP Method: PUT
- Route: localhost:8000/tasks/:id
- Authentication: Bearer Token - "token" attribute from Authentication route
- Body format:
{
    "description" : string
}
- Body example:
{
    "description" : "wash the car"
}

#### Response

- Response Status Codes:
    - 200 OK
    - 401 Unauthorized
    - 404 Not Found
    - 422 Unprocessable Content
- Response type: json object
- Reponse Body (200 OK):
{
	"message": "Task updated.",
	"task": {
		"id": "9ca253bf-2cc9-4850-b966-7848f4aee3b9",
		"description": "buy dinner",
		"completed": false,
		"created_at": "2024-07-28T23:40:36.000000Z",
		"updated_at": "2024-07-29T02:22:54.000000Z",
		"user_id": "9ca25386-59fd-4e6d-b8cb-a89b5537bd13"
	}
}

### Deleting Tasks

#### Request

- HTTP Method: DELETE
- Route: localhost:8000/tasks/:id
- Authentication: Bearer Token - "token" attribute from Authentication route
- Body format:
no body

#### Response

- Response Status Codes:
    - 200 OK
    - 401 Unauthorized
    - 404 Not Found
    - 422 Unprocessable Content
- Response type: json object
- Reponse Body (200 OK):
{
	"message": "Task deleted.",
	"task_id": "9ca253bf-2cc9-4850-b966-7848f4aee3b9",
	"task_description": "buy dinner"
}
