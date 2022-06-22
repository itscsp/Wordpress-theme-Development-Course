# To trem word from long text
## syntax : echo wp_trim_words(text, limit)
## example : echo wp_trim_words(get_the_content(), 15)


# To format date from custom field

## $eventDate = new DateTime(get_field('event_date')); // here we geting data from custom field
## echo $eventDate->format('M'); // with the help of DateTime Object we format it how we wanted