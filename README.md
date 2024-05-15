# MoneyLendingChallenge

The application is used to provide loan with breakdown
of repayment schedule including interest amount, rate, etc. 
on the basis of city, date of birth, credit score.

To run this application:
* Clone the repo
* Install the dependency to run a php application
* Start php as service
* Start the application using

  `php -S 127.0.0.1:8080`

Run the Unit Tests using following command:

`./vendor/bin/phpunit UnitTests/`

API structure:
* Request Type - GET
* Endpoint - http://127.0.0.1:8080/Loan
* Query Parameters

|param|type|sample|description|
|---|---|---|---|
|amount|int|50000|>50k and <5L and mulitple of 10k|
| city|string|Hubli|city name|
| score|int|900|between 0 - 900(both included)|
| dob|string|1996-05-13|date of birth|
| name|string|M R|Name of the Applicant|

Response:
* Content-type: application/json
* Success
```json
{
    "status": "Approve",
    "Rate of Interest": "11%",
    "schedule": [
        {
            "Principal": 4167,
            "Interest": 458,
            "EMI Date": "01/05/2022"
        },
        {
            "Principal": 4167,
            "Interest": 458,
            "EMI Date": "01/06/2022"
        },
        {
            "Principal": 4167,
            "Interest": 458,
            "EMI Date": "01/07/2022"
        },
        {
            "Principal": 4167,
            "Interest": 458,
            "EMI Date": "01/08/2022"
        },
        {
            "Principal": 4167,
            "Interest": 458,
            "EMI Date": "01/09/2022"
        },
        {
            "Principal": 4167,
            "Interest": 458,
            "EMI Date": "01/10/2022"
        },
        {
            "Principal": 4167,
            "Interest": 458,
            "EMI Date": "01/11/2022"
        },
        {
            "Principal": 4167,
            "Interest": 458,
            "EMI Date": "01/12/2022"
        },
        {
            "Principal": 4167,
            "Interest": 458,
            "EMI Date": "01/01/2023"
        },
        {
            "Principal": 4167,
            "Interest": 458,
            "EMI Date": "01/02/2023"
        },
        {
            "Principal": 4167,
            "Interest": 458,
            "EMI Date": "01/03/2023"
        },
        {
            "Principal": 4167,
            "Interest": 458,
            "EMI Date": "01/04/2023"
        }
    ]
}
```
* Failure
```json
{
    "error": "Score is less for the tier2 city",
    "status": "Reject"
}
```
