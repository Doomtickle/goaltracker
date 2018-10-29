# Goal Tracker
Proof of concept for a simple goal tracking API

## Data Model
![alt text](https://i.imgur.com/jiIpBBs.jpg "DataModel")

## Summary of work completed
A simple goal tracking API using the Laravel PHP framework. I mostly concerned myself with the MVC portion for the basic crud operations of all the components (goals, milestones, logs). This is how I would get started making a web application using laravel for the API in the back end and consuming the api with a VueJS SPA on the front end.

Notes:
 - Users can add as many milestones as they like to a goal and also mark them complete. Figuring out progress for the goal would be a pretty simple formula of dividing the completed milestones for that goal by the total numer of milestones for that goal and multiplying by 100.
 - I would start thinking about adding different milestone types (nominal, ordinal, interval) and conditionally display the goals progress where appropriate. Example: If my goal was just to spend more time with my grandma, theoretically that should never be complete as it's an open ended goal. In this case, the user should never even see the progress towards the goal. They could use this tool as a simple tracker to make sure they're maximizing grandma time.
