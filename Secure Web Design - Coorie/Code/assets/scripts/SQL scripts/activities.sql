
# *****************************************************
# *** Create the table structure for the table 'activities' *****
# *****************************************************

DROP TABLE IF EXISTS `activities`;
CREATE TABLE IF NOT EXISTS `activities` (
  `name` varchar(30) NOT NULL,
  `imagePath` varchar(255) NOT NULL,
  `altImage` varchar(255) NOT NULL,
  `description` varchar(500) NOT NULL,
  `format` varchar(200) NOT NULL,
  `activityLevel` varchar(50) NOT NULL,
  `cost` varchar(200) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;


# *****************************************************
# ***Insert record data for the table `activities`**********
# *****************************************************

INSERT INTO `activities` VALUES

('Climbing', '/PE7045/assets/images/activities/climbing.jpg', 'picture of man climbing a rockface', 'With its mountain landscapes, deep glens, lochs, 
rivers and hundreds of islands, there is a great wealth and diversity of rock climbing to be found in Scotland.', 'Instructor-led.', 'Very active.', 
'Additional charge of £50 per person per half-day session.'), 

('Cycling', '/PE7045/assets/images/activities/cycling.jpg', 'picture of man cycling in a forest', 'Mountain bikes, helmets and other equipment are 
provided at selected accommodation so guests can explore the surrounding area on two wheels.', 'Self-led.', 'Moderately active.', 
'Included in accommodation, so no additional charge.'), 

('Fishing', '/PE7045/assets/images/activities/fishing.jpg', 'picture of man fishing by a lake', 'Fishing rods and other equipment are provided at all 
accommodation near water where there are fish.', 'Self-led.', 'Lightly active.', 'Included in accommodation, so no additional charge.'), 

('Foraging', '/PE7045/assets/images/activities/foraging.jpg', 'picture of basket containing mushrooms and other foraged items', 'Guests can pick brambles,
 wild garlic, elderflowers, mushrooms and other wild food from the woodlands, hedgerows, moorland and seashores near their accommodation.', 'Instructor-led.',
 'Lightly active.', 'Additional charge of £20 per person per half-day session.'), 

('Hiking', '/PE7045/assets/images/activities/hiking.jpg', 'picture of man hiking near Ben Nevis', 'Maps of pre-planned trails are provided for experienced hikers.
 Alternatively, guests can choose to join a one-day expedition led by an instructor.', 'Instructor or self-led.', 'Moderately to very active.', 'Additional charge 
of £20 per person for instructor-led expeditions.'), 

('Horse Riding', '/PE7045/assets/images/activities/horse_riding.jpg', 'picture of girl riding horse in a forest', 'Guests can explore the landscapes around their 
accommodation by horseback on a half-day expedition. No prior experience is necessary.', 'Instructor-led.', 'Moderately active.', 'Additional charge of £50 per 
person per half-day expedition.'), 

('Kayaking', '/PE7045/assets/images/activities/kayaking.jpg', 'picture of two people in a double-kayak on a lake', 'Half-day tours offer guests the opportunity to 
explore the lakes and waterways near their accommodation. No prior experience is necessary.', 'Instructor-led.', 'Moderately active.', 'The tours incur an additional 
cost of £20 per person.'), 

('Meditation', '/PE7045/assets/images/activities/meditation.jpg', 'picture of woman outdoors sitting cross-legged', 'Instructional materials are provided for those 
interested in self-guided meditation. Group classes are also available.', 'Instructor or self-led.', 'Sedentary.', 'Additional charge of £20 per person for 
instructor-led classes. Self-led is included in the accommodation charge.'), 

('Paddleboarding', '/PE7045/assets/images/activities/paddleboarding.jpg', 'picture of five people paddleboarding on the sea', 'Offering an alternative to kayaking, 
guests can paddleboard their way around the lakes and waterways near their accommodation.', 'Instructor or self-led.', 'Moderately active.', 'Additional charge of 
£40 per person for instructor-led sessions. Self-led is included in the accommodation charge.'), 

('Painting', '/PE7045/assets/images/activities/painting.jpg', 'picture of woman painting a picture by the sea', 'Materials are provided so guests can get creative 
and paint their surroundings.', 'Self-led.', 'Sedentary.', 'Included in accommodation, so no additional charge.'), 

('Stargazing', '/PE7045/assets/images/activities/stargazing.jpg', 'picture of man looking at a starry sky at night', 'Guests can follow the guides provided in the 
accommodation to identify the stars in the night sky. If they are lucky, they might even see the Northern Lights.', 'Self-led.', 'Sedentary.', 
'Included in accommodation, so no additional charge.'), 

('Wild Swimming', '/PE7045/assets/images/activities/wild_swimming.jpg', 'picture of woman swimming in lake by some mountains', 'Two-hour swimming sessions are offered 
in the lakes and waterways near selected accommodation.', 'Instructor-led.', 'Moderately active.', 'Additional charge of £20 per person per two-hour session.'), 

('Yoga', '/PE7045/assets/images/activities/yoga.jpg', 'picture of woman outside in a yoga pose by the sea', 'Guests can join a class led by an instructor
 or follow a video to be guided through a lesson at their own pace.', 'Instructor and self-led.', 'Lightly active.', 'Additional charge of £20 per person 
for instructor-led classes. Self-led is included in the accommodation charge.');
