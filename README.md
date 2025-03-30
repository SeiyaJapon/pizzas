# Pizzeria Repository

Here is the repository containing the pizzeria’s content.

Despite what was stated in the second point of the description, I'm not sure if I chose one of the proposed approaches.  
As a result, there is a strange mix of things.

## Proposed Approaches

You proposed three paths:

1. **Build the complete Pizza House application**  
   Refining the application and basing it on the provided draft.  
   I discarded this option because, even though I downloaded the code, I had to eliminate parts of it. There were several reasons:  
   - From your perspective (as the test creators), what you provide might be very clear; however, for someone receiving the code, it is not so obvious.  
   - It is unclear whether the company's working style is reflected in the file/folder structure, the coding approach, or the methodology to be used. I believe this influences more than one might realize, which clashes with someone coming from outside.  
   - Additionally, adapting to a way of coding that may be different from what you're used to is always complex and can lead to errors and frustration.  
   - You might also encounter parts that are deliberately implemented incorrectly or in an unconventional way so they can be corrected. But, as there is always doubt, this can be a conflicting point.

2. **Focus on the “kitchen” context**  
   I might have chosen the second option since I focused heavily on the kitchen context. However, I also created additional content that I later did not use, but which hints at how each element would be separated.  
   - I created tests, but not all that should be created, and I didn’t even have time to run them.  
   - I implemented events, but only as a sample.

3. **Hybrid approach**  
   The third point—indicating a hybrid approach—also resembles what I did.  
   So, it is possible that I ended up mixing these two options.

## Additional Considerations

- **User Stories:**  
  I did not focus on any specific user story. Perhaps creating a pizza or placing an order, but only as a sample—since orders do not have separate lines with quantities, etc.

- **Quantities and MVP vs. DDD:**  
  The description mentioned building an MVP. However, in many cases, creating an MVP conflicted with the idea of properly maintaining DDD.  
  For example, it would have been very easy for the pizza entity to include a price to build an MVP. But that would break DDD since the price should not be part of the pizza entity. It belongs to the sales domain, so it should be managed from another context.

  The same occurred with quantities (e.g., in an order). Since I worked quickly to generate as much as possible, I may have left some loose ends in certain areas.

- **Frontend vs. Backend:**  
  I did not focus on any front-end work, only the backend, as you mentioned that it was more important.

- **Overall Scope:**  
  My intention was to cover as much ground as possible—not to ensure everything functions perfectly (since you mentioned that wasn’t the main focus), but to demonstrate that I can implement DDD, CQRS, and events. Event sourcing would also be nice, especially since payments are the most important, but that is another topic.

- **Docker and Dependencies:**  
  I adapted a Docker setup I already had to the project’s needs. Likely, more libraries than necessary are installed, but I didn’t want to risk missing something.  
  I also adapted a Makefile with a variety of instructions to help if needed.

  In practice, it should be simple. Using that file, you would first run `make create-network` and then `make up`. Next, run `composer install`. There is a command for this, but if you prefer, you can run `make enter` to access the container and execute it manually—whichever you prefer. Finally, run the migrations. I’d say that should be it.

## Final Thoughts

To be honest, I did not like this test. I have done quite a few tests before, but I have never been given one this large with so little time.

You mentioned that you would like to see the “ability to work under pressure, prioritize, and make decisions.”  
This makes me think that working under pressure and in a rush might be commonplace for you, which is very concerning in our field. I understand that sometimes (once or twice a year) things might be rushed because of urgency, but if that is the norm, it leaves a bad taste in your mouth right from the start—making you wonder, “Where do they expect me to fit in?”

Apart from this, you asked for an MVP, but I chose to focus on demonstrating other aspects. This decision is part of the choices you wanted us to make.

And that is all.