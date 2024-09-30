# Disaster Check In

![asheville_phone_number](https://github.com/user-attachments/assets/e65312f4-ebbe-45b1-8c4e-622580812bee)

From Daniel Coulbourne:

> @everyone Hey if you didn't hear Asheville is totally fucked by the recent hurricane
>
> The radio stations are filled with people asking "have you heard from this specific person" and it's really inefficient.
>
> I want to build a primarily SMS based app for people to notify that they are safe and check whether people are safe. We can call into the radio stations to notify people about the app
>
> I don't have reliable power and internet or I would build it myself. I will pay for any infrastructure. Or reach out to John Drexler who can spin up any servers or whatever needed with the thunk credit card
>
> Here's the spec
>
> HELP:
> Return a list of available commands
>
> UPDATE:
> SMS message like this:
> Update Daniel Coulbourne
> I am safe. No power no cell service. Plenty of food, water and propane.
>
> This saves in the DB keyed by phone number.
>
> SEARCH:
> SMS message like this
> Search 8288880440
>
> Searches DB for that phone number.
> If found:
> Found Daniel Coulbourne
> "I am safe. No power no cell service. Plenty of food, water and propane."
>
> If not found:
> No update from 8288880440. Respond YES to be notified if they submit an update.
>
> It would be good to have a web search as well, and we should have a confirmation flow for your first update saying "this information will be public to anyone who knows your phone number so don't share anything you don't want publicly available."
