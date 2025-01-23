
# *****************************************************
# ***Create `accommodation` table **********
# *****************************************************

DROP TABLE IF EXISTS `accommodation`;
CREATE TABLE `accommodation` (
  `accommodationID` mediumint(8) PRIMARY KEY AUTO_INCREMENT,
  `accommodation_name` varchar(255) NOT NULL,
  `price_per_night` DECIMAL(7,2) NOT NULL,
  `location` text NOT NULL,
  `area` text NOT NULL,
  `description` text NOT NULL,
  `guests` smallint(2) NOT NULL,
  `bedrooms` smallint(2) NOT NULL,
  `bathrooms` smallint(2) NOT NULL,
  `kitchen` char(1) NOT NULL CHECK (kitchen IN ('Y', 'N')),
  `garden` char(1) NOT NULL CHECK (garden IN ('Y', 'N')),
  `parking` char(1) NOT NULL CHECK (parking IN ('Y', 'N')),
  `bbq` char(1) NOT NULL CHECK (bbq IN ('Y', 'N')),
  `wifi` char(1) NOT NULL CHECK (wifi IN ('Y', 'N')),
  `tv` char(1) NOT NULL CHECK (tv IN ('Y', 'N')),
  `air_con` char(1) NOT NULL CHECK (air_con IN ('Y', 'N')),
  `pets_welcome` char(1) NOT NULL CHECK (pets_welcome IN ('Y', 'N')),
  `hiking` char(1) NOT NULL CHECK (hiking IN ('Y', 'N')),
  `climbing` char(1) NOT NULL CHECK (climbing IN ('Y', 'N')),
  `horse_riding` char(1) NOT NULL CHECK (horse_riding IN ('Y', 'N')),
  `wild_swimming` char(1) NOT NULL CHECK (wild_swimming IN ('Y', 'N')),
  `kayaking` char(1) NOT NULL CHECK (kayaking IN ('Y', 'N')),
  `paddleboarding` char(1) NOT NULL CHECK (paddleboarding IN ('Y', 'N')),
  `cycling` char(1) NOT NULL CHECK (cycling IN ('Y', 'N')),
  `fishing` char(1) NOT NULL CHECK (fishing IN ('Y', 'N')),
  `foraging` char(1) NOT NULL CHECK (foraging IN ('Y', 'N')),
  `yoga` char(1) NOT NULL CHECK (yoga IN ('Y', 'N')),
  `meditation` char(1) NOT NULL CHECK (meditation IN ('Y', 'N')),
  `stargazing` char(1) NOT NULL CHECK (stargazing IN ('Y', 'N')),
  `painting` char(1) NOT NULL CHECK (painting IN ('Y', 'N')),
  `latitude` varchar(50) NOT NULL,
  `longitude` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


# *****************************************************
# ***Create `accom_photos` table **********
# *****************************************************

DROP TABLE IF EXISTS `accom_photos`;
CREATE TABLE `accom_photos` (
  `accommodationID` mediumint(8) PRIMARY KEY,
  `img1` varchar(255), 
  `alt1` varchar(255), 
  `img2` varchar(255), 
  `alt2` varchar(255), 
  `img3` varchar(255), 
  `alt3` varchar(255), 
  `img4` varchar(255), 
  `alt4` varchar(255), 
  `img5` varchar(255), 
  `alt5` varchar(255), 
  `img6` varchar(255), 
  `alt6` varchar(255), 
  `img7` varchar(255), 
  `alt7` varchar(255), 
  `img8` varchar(255), 
  `alt8` varchar(255), 
  `img9` varchar(255), 
  `alt9` varchar(255), 
  FOREIGN KEY (accommodationID) REFERENCES accommodation (accommodationID)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


# *****************************************************
# ***Insert record data for the table `accommodation`**********
# *****************************************************

INSERT INTO `accommodation` VALUES

(0001, 'Loch Hosta Cottage', 100.00, 'Hosta', 'North Uist', 'The Cottage on Loch Hosta is a traditional cottage that is a perfect little hideaway 
just for two, set in a wonderful spot looking out over Loch Hosta and only 5 minutes walk from the gorgeous sandy Hosta beach, on the island of North 
Uist in the Outer Hebrides.', 2, 1, 1, 'Y', 'Y', 'Y', 'N', 'N', 'Y', 'N', 'Y', 'Y', 'N', 'N', 'Y', 'Y', 'Y', 'N', 'Y', 'N', 'Y', 'Y', 'Y', 'Y', 
'57.62235106208042', '-7.488285129067541'),

(0002, 'The Black Barn', 120.00, 'Sound of Sleat', 'Isle of Skye', 'The Black Barn is a delightful detached house set in a gorgeous spot looking out 
towards the sea in the scenic area of Sleat on the south coast of the wonderful Isle of Skye.', 2, 1, 1, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'N', 'N', 'Y', 'Y', 
'N', 'Y', 'Y', 'Y', 'Y', 'N', 'N', 'Y', 'N', 'Y', 'Y', '57.0944220289695', '-5.867601730891316'),   

(0003, 'Achnacarron Boathouse', 145.00, 'Loch Awe', 'Argyll', 'Loch Awe, the longest freshwater loch in Scotland, runs south west from the A85 about 20 miles 
east of Oban and is one of the most beautiful and most photographed of the Scottish lochs, having the iconic ruin of Kilchurn Castle at its northern end. About 
a quarter of the way down its peaceful western shore and right on the water, is Achnacarron Boathouse.', 4, 2, 2, 'Y', 'N', 'Y', 'Y', 'Y', 'Y', 'Y', 'N', 'Y', 'N', 
'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'N', 'Y', 'Y', 'Y', 'N', '56.35090470157509', '-5.140844957377598'),   

(0004, 'Pyatshaw Burn Cottage', 105.00, 'Near Lauder', 'Scottish Borders', 'Pyatshaw Burn Cottage is a cosy detached cottage nestled amongst trees and overlooking 
a pretty little burn, just 3.5 miles from Lauder in the Scottish Borders. This warm and inviting cottage makes the ideal romantic retreat as it has been set up 
perfectly just for two.', 2, 1, 1, 'Y', 'Y', 'Y', 'N', 'Y', 'Y', 'Y', 'N', 'Y', 'Y', 'Y', 'N', 'N', 'N', 'Y', 'N', 'Y', 'Y', 'Y', 'N', 'Y', 
'55.726307490509335', '-2.661471855765555'),   

(0005, 'The Folly at Old Melrose', 95.00, 'Near Melrose', 'Scottish Borders', 'Nestled amidst the tranquil forest within the Old Melrose Estate is The Folly at 
Old Melrose that is set in a delightful elevated position right by the River Tweed with gorgeous views out over the river, in the Scottish Borders near Melrose
 (2.5 miles). The Folly\’s peaceful setting is just part of its charm sitting as it does surrounded by woodland and the sound of birds singing in the trees.', 
2, 1, 1, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'N', 'Y', 'Y', 'Y', 'Y', 'N', 'N', 'N', 'Y', 'N', 'Y', 'Y', 'Y', 'N', 'Y', '55.60065182851452', '-2.65276407423574'),   

(0006, 'Loch Awe Boathouse', 140.00, 'Loch Awe', 'Argyll', 'Loch Awe Boathouse is a stylish and beautifully presented, detached house that is perfect for families 
in an absolutely stunning location right on the shore of Loch Awe, near Taynuilt (3.5 miles).', 4, 2, 2, 'Y', 'N', 'Y', 'N', 'Y', 'Y', 'Y', 'N', 'Y', 'N', 'N', 'Y', 
'Y', 'Y', 'Y', 'Y', 'N', 'Y', 'Y', 'Y', 'N', '56.351527209895096', '-5.139497904710648'), 

(0007, 'The Owl House', 110.00, 'Near St Andrews', 'Fife', 'The Owl House is an inviting, handcrafted wooden lodge tucked away in a private woodland setting, with 
the added bonus of a luxurious, outdoor hot tub in its grounds. It offers the best of both worlds with a tranquil rural setting that is combined with easy access to 
picturesque St Andrews (3.5 miles) in Fife.', 2, 1, 1, 'Y', 'Y', 'Y', 'N', 'Y', 'Y', 'N', 'Y', 'N', 'N', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'N', 'Y', 
'56.30580689398974', '-2.890957622771141'), 

(0008, 'The Hillside Hideaway', 95.00, 'Near Carbost', 'Isle of Skye', 'The Hillside Hideaway is a chic, modern retreat that sits on its own in a dramatic hillside 
situation looking out over stunning Loch Harport, just half a mile from Carbost on the scenic Isle of Skye. The house has been built right into the hillside to make 
the very most of the incredible view.', 2, 1, 1, 'Y', 'N', 'Y', 'N', 'Y', 'Y', 'N', 'N', 'Y', 'Y', 'N', 'Y', 'Y', 'Y', 'N', 'Y', 'N', 'Y', 'Y', 'Y', 'Y', 
'57.305003194834256', '-6.360075347781275'), 

(0009, 'Coachmaker\'s Cottage', 215.00, 'Loch Awe', 'Argyll', 'Coachmaker\’s Cottage occupies an enchanting lochside position surrounded by trees, on the shore of 
Loch Awe near Portsonachan in Argyll. Set behind a gated entrance and down an elegant, sweeping driveway its grounds extend to around 2 acres with a wonderful private 
stretch of loch frontage.', 6, 3, 3, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'N', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'N', 'N', 'N', 'Y', 'Y', 
'56.34234409508987', '-5.133284739115807'), 

(0010, 'The Old Lobster House', 120.00, 'Lower Burnmouth', 'Eyemouth', 'In a picturesque setting right on the seafront in the pretty fishing village of Burnmouth 
sits The Old Lobster House, 6 miles north of Berwick-upon-Tweed on Scotland\’s beautiful east coast. Converted from what was originally an old lobster holding pen 
this quaint cottage has stunning views out to sea whilst inside having all the creature comforts you could wish for.', 3, 2, 2, 'Y', 'N', 'N', 'N', 'Y', 'Y', 'N', 
'Y', 'N', 'N', 'N', 'Y', 'Y', 'Y', 'N', 'Y', 'N', 'N', 'N', 'N', 'N', '55.840741900558626', '-2.0651758864934453'), 

(0011, 'Tigh Na Mara', 250.00, 'Salen', 'Argyll', 'Scotland is famed for its breathtaking lochs and mountains and this property certainly lives up to the reputation. 
Sitting within the pretty village of Salen on the foreshore of Loch Sunart on the Ardnamurchan peninsula, Tigh Na Mara commands amazing views across the water and the 
hills beyond.', 8, 4, 3, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'N', 'Y', 'Y', 'Y', 'N', 'Y', 'N', 'Y', 'Y', 'Y', 'N', 
'56.71368066674202', '-5.778621095104257'), 

(0012, 'Clippie Lodge', 175.00, 'Ballater', 'Royal Deeside', 'A most charming and characterful property set in the centre of Ballater within the wonderful Cairngorms 
National Park, Clippie Lodge is a historic building with a fascinating past as part of the village\’s former bus station. This fantastic house is named after the drivers 
and conductors or \‘clippies\’ that worked on the buses and used to sleep upstairs.', 4, 2, 3, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'N', 'Y', 'Y', 'Y', 'Y', 'N', 'N', 'N', 'Y', 
'N', 'Y', 'Y', 'Y', 'Y', 'Y', '57.049313665273026', '-3.0415148797931053'), 

(0013, 'Boom House', 195.00, 'Loch Ewe', 'Wester Ross', 'Here is another wonderful hideaway for those who are looking for that elusive combination of shoreline and 
mountains, sublime comfort and fabulous views. Boom House, about 35 minutes\' drive from Gairloch and 5 miles from Poolewe in fabulous northwest Scotland ticks all these 
boxes.', 6, 3, 2, 'Y', 'Y', 'Y', 'N', 'Y', 'Y', 'N', 'Y', 'Y', 'Y', 'N', 'Y', 'Y', 'Y', 'Y', 'Y', 'N', 'Y', 'Y', 'Y', 'N', '57.85805720490949', '-5.6404685983981'), 

(0014, 'Rientraid Cottage', 220.00, 'Loch a\' Chairn Bhain', 'Sutherland', 'Rientraid Cottage is a traditional, detached house set in a spectacular location amongst 
one of Scotland\’s most dramatic and rugged landscapes near Lochinver (18.5 miles) in Sutherland, with a stunning view out over Loch a\’ Chairn Bhain.', 6, 3, 2, 'Y', 
'N', 'Y', 'N', 'Y', 'Y', 'N', 'Y', 'Y', 'N', 'Y', 'Y', 'Y', 'Y', 'N', 'Y', 'N', 'N', 'N', 'Y', 'Y', '58.25172462604783', '-5.0797031105741');


# *****************************************************
# ***Insert record data for the table `accom_photos`**********
# *****************************************************

INSERT INTO `accom_photos` VALUES

(0001, 
'/PE7045/assets/images/accom_id_0001/loch_hosta_cottage.jpg', 'photo of front of cottage', 
'/PE7045/assets/images/accom_id_0001/loch_hosta_cottage2.jpg', 'photo of back of cottage', 
'/PE7045/assets/images/accom_id_0001/loch_hosta_cottage3.jpg', 'photo of living room', 
'/PE7045/assets/images/accom_id_0001/loch_hosta_cottage4.jpg', 'photo of kitchen', 
'/PE7045/assets/images/accom_id_0001/loch_hosta_cottage5.jpg', 'photo of kitchen worktops', 
'/PE7045/assets/images/accom_id_0001/loch_hosta_cottage6.jpg', 'photo of main bedroom', 
'/PE7045/assets/images/accom_id_0001/loch_hosta_cottage7.jpg', 'photo of bathroom', 
'/PE7045/assets/images/accom_id_0001/loch_hosta_cottage8.jpg', 'photo of cottage from outside with the loch in the background', 
'/PE7045/assets/images/accom_id_0001/loch_hosta_cottage9.jpg', 'photo of the nearby beach'),

(0002, 
'/PE7045/assets/images/accom_id_0002/black_barn_skye.jpg', 'photo of back of barn and its garden', 
'/PE7045/assets/images/accom_id_0002/black_barn_skye2.jpg', 'photo of living room', 
'/PE7045/assets/images/accom_id_0002/black_barn_skye3.jpg', 'photo of kitchen', 
'/PE7045/assets/images/accom_id_0002/black_barn_skye4.jpg', 'photo of dining area and scenary outside patio door', 
'/PE7045/assets/images/accom_id_0002/black_barn_skye5.jpg', 'photo of main bedroom', 
'/PE7045/assets/images/accom_id_0002/black_barn_skye6.jpg', 'photo of bathroom', 
'/PE7045/assets/images/accom_id_0002/black_barn_skye7.jpg', 'photo of outside decking area and garden with the sea in the background', 
'/PE7045/assets/images/accom_id_0002/black_barn_skye8.jpg', 'photo of back of barn and its garden', 
'/PE7045/assets/images/accom_id_0002/black_barn_skye9.jpg', 'photo of chairs on decking area'),

(0003, 
'/PE7045/assets/images/accom_id_0003/achnacarron_boathouse.jpg', 'photo of boathouse from Loch Awe', 
'/PE7045/assets/images/accom_id_0003/achnacarron_boathouse2.jpg', 'photo of living room', 
'/PE7045/assets/images/accom_id_0003/achnacarron_boathouse3.jpg', 'photo of kitchen', 
'/PE7045/assets/images/accom_id_0003/achnacarron_boathouse4.jpg', 'photo of first double bedroom', 
'/PE7045/assets/images/accom_id_0003/achnacarron_boathouse5.jpg', 'photo of first bathroom', 
'/PE7045/assets/images/accom_id_0003/achnacarron_boathouse6.jpg', 'photo of second double bedroom', 
'/PE7045/assets/images/accom_id_0003/achnacarron_boathouse7.jpg', 'photo of second bathroom', 
'/PE7045/assets/images/accom_id_0003/achnacarron_boathouse8.jpg', 'photo of upstairs sitting area with view of the Loch through the window', 
'/PE7045/assets/images/accom_id_0003/achnacarron_boathouse9.jpg', 'photo of outdoor decking area with the Loch in the background'),

(0004, 
'/PE7045/assets/images/accom_id_0004/pyatshaw_cottage.jpg', 'photo of front of cottage', 
'/PE7045/assets/images/accom_id_0004/pyatshaw_cottage2.jpg', 'photo of living room', 
'/PE7045/assets/images/accom_id_0004/pyatshaw_cottage3.jpg', 'photo of dining area and kitchen', 
'/PE7045/assets/images/accom_id_0004/pyatshaw_cottage4.jpg', 'photo of main bedroom', 
'/PE7045/assets/images/accom_id_0004/pyatshaw_cottage5.jpg', 'photo of main bedroom leading to hallway', 
'/PE7045/assets/images/accom_id_0004/pyatshaw_cottage6.jpg', 'photo of bathroom', 
'/PE7045/assets/images/accom_id_0004/pyatshaw_cottage7.jpg', 'photo of path leading to cottage entrance and outdoor surroundings', 
'/PE7045/assets/images/accom_id_0004/pyatshaw_cottage8.jpg', 'photo of outdoor sitting area', 
'/PE7045/assets/images/accom_id_0004/pyatshaw_cottage9.jpg', 'photo of nearby countryside'),

(0005, 
'/PE7045/assets/images/accom_id_0005/folly.jpg', 'birdseye view of property and outdoor sitting area', 
'/PE7045/assets/images/accom_id_0005/folly2.jpg', 'photo of living room', 
'/PE7045/assets/images/accom_id_0005/folly3.jpg', 'photo of dining area and spiral staircase', 
'/PE7045/assets/images/accom_id_0005/folly4.jpg', 'photo of kitchen', 
'/PE7045/assets/images/accom_id_0005/folly5.jpg', 'photo of bathroom', 
'/PE7045/assets/images/accom_id_0005/folly6.jpg', 'photo of main bedroom', 
'/PE7045/assets/images/accom_id_0005/folly7.jpg', 'photo of outdoor sitting area', 
'/PE7045/assets/images/accom_id_0005/folly8.jpg', 'photo of front of property and path leading to it', 
'/PE7045/assets/images/accom_id_0005/folly9.jpg', 'photo of nearby countryside and forests'),

(0006, 
'/PE7045/assets/images/accom_id_0006/loch_awe_boathouse.jpg', 'photo of entrance to boathouse with Loch Awe in the background', 
'/PE7045/assets/images/accom_id_0006/loch_awe_boathouse2.jpg', 'photo of outdoor sitting area', 
'/PE7045/assets/images/accom_id_0006/loch_awe_boathouse3.jpg', 'photo of living room', 
'/PE7045/assets/images/accom_id_0006/loch_awe_boathouse4.jpg', 'photo of kitchen and dining area', 
'/PE7045/assets/images/accom_id_0006/loch_awe_boathouse5.jpg', 'photo of first bedroom with two single beds', 
'/PE7045/assets/images/accom_id_0006/loch_awe_boathouse6.jpg', 'photo of bathroom', 
'/PE7045/assets/images/accom_id_0006/loch_awe_boathouse7.jpg', 'photo of main double bedroom with bath tub and view of the Loch', 
'/PE7045/assets/images/accom_id_0006/loch_awe_boathouse8.jpg', 'photo of main bedroom en-suite bathroom', 
'/PE7045/assets/images/accom_id_0006/loch_awe_boathouse9.jpg', 'photo of kayaks and boats in storage area'),

(0007, 
'/PE7045/assets/images/accom_id_0007/owl_house.jpg', 'photo of back of house and outdoor decking area', 
'/PE7045/assets/images/accom_id_0007/owl_house2.jpg', 'photo of outdoor hot tub', 
'/PE7045/assets/images/accom_id_0007/owl_house3.jpg', 'photo of decking area', 
'/PE7045/assets/images/accom_id_0007/owl_house4.jpg', 'photo of living area and kitchen', 
'/PE7045/assets/images/accom_id_0007/owl_house5.jpg', 'photo of kitchen', 
'/PE7045/assets/images/accom_id_0007/owl_house6.jpg', 'photo of bed and sofa in shared living area', 
'/PE7045/assets/images/accom_id_0007/owl_house7.jpg', 'photo of copper bathtub in shared living area', 
'/PE7045/assets/images/accom_id_0007/owl_house8.jpg', 'photo of bathroom', 
'/PE7045/assets/images/accom_id_0007/owl_house9.jpg', 'photo of back of house and nearby trees'),

(0008, 
'/PE7045/assets/images/accom_id_0008/hillside_hideaway.jpg', 'birdseye view of house, the Loch and the surrounding hills', 
'/PE7045/assets/images/accom_id_0008/hillside_hideaway2.jpg', 'photo of sitting area and the Loch through the glass facade', 
'/PE7045/assets/images/accom_id_0008/hillside_hideaway3.jpg', 'photo of second sitting area and kitchen', 
'/PE7045/assets/images/accom_id_0008/hillside_hideaway4.jpg', 'photo of kitchen', 
'/PE7045/assets/images/accom_id_0008/hillside_hideaway5.jpg', 'photo of outdoor decking area and view of the Loch', 
'/PE7045/assets/images/accom_id_0008/hillside_hideaway6.jpg', 'photo of the main bedroom', 
'/PE7045/assets/images/accom_id_0008/hillside_hideaway7.jpg', 'photo of the bathroom', 
'/PE7045/assets/images/accom_id_0008/hillside_hideaway8.jpg', 'photo of side of house and view of the Loch', 
'/PE7045/assets/images/accom_id_0008/hillside_hideaway9.jpg', 'photo of the entrance to the house and Loch in the background'),

(0009, 
'/PE7045/assets/images/accom_id_0009/coachmakers.jpg', 'photo of outside of cottage and its driveway', 
'/PE7045/assets/images/accom_id_0009/coachmakers2.jpg', 'photo of front of cottage and the surrounding area', 
'/PE7045/assets/images/accom_id_0009/coachmakers3.jpg', 'photo of sitting area', 
'/PE7045/assets/images/accom_id_0009/coachmakers4.jpg', 'photo of dining area with sitting area in the background', 
'/PE7045/assets/images/accom_id_0009/coachmakers5.jpg', 'photo of kitchen', 
'/PE7045/assets/images/accom_id_0009/coachmakers6.jpg', 'photo of first double bedroom', 
'/PE7045/assets/images/accom_id_0009/coachmakers7.jpg', 'photo of second double bedroom', 
'/PE7045/assets/images/accom_id_0009/coachmakers8.jpg', 'photo of third bedroom with two single beds', 
'/PE7045/assets/images/accom_id_0009/coachmakers9.jpg', 'photo of gate at entrance to the grounds of the cottage'),

(0010, 
'/PE7045/assets/images/accom_id_0010/old-lobster-house.jpg', 'birdseye view of area and sea surrounding the house', 
'/PE7045/assets/images/accom_id_0010/old-lobster-house2.jpg', 'photo of road leading to the house', 
'/PE7045/assets/images/accom_id_0010/old-lobster-house3.jpg', 'photo of living room', 
'/PE7045/assets/images/accom_id_0010/old-lobster-house4.jpg', 'photo of living room and dining area in background', 
'/PE7045/assets/images/accom_id_0010/old-lobster-house5.jpg', 'photo of kitchen', 
'/PE7045/assets/images/accom_id_0010/old-lobster-house6.jpg', 'photo of main double bedroom', 
'/PE7045/assets/images/accom_id_0010/old-lobster-house7.jpg', 'photo of bathroom', 
'/PE7045/assets/images/accom_id_0010/old-lobster-house8.jpg', 'photo of attic room with sofa bed', 
'/PE7045/assets/images/accom_id_0010/old-lobster-house9.jpg', 'photo of attic bathroom'),

(0011, 
'/PE7045/assets/images/accom_id_0011/tighnamara.jpg', 'view of house from nearby Loch Sunart', 
'/PE7045/assets/images/accom_id_0011/tighnamara2.jpg', 'photo of sitting area with the Loch seen through the windows', 
'/PE7045/assets/images/accom_id_0011/tighnamara3.jpg', 'photo of second sitting area', 
'/PE7045/assets/images/accom_id_0011/tighnamara4.jpg', 'photo of kitchen', 
'/PE7045/assets/images/accom_id_0011/tighnamara5.jpg', 'photo of first double bedroom', 
'/PE7045/assets/images/accom_id_0011/tighnamara6.jpg', 'photo of second double bedroom', 
'/PE7045/assets/images/accom_id_0011/tighnamara7.jpg', 'photo of third bedroom with two single beds', 
'/PE7045/assets/images/accom_id_0011/tighnamara8.jpg', 'photo of fourth bedroom with two single beds', 
'/PE7045/assets/images/accom_id_0011/tighnamara9.jpg', 'photo of outdoor decking area and Loch in the background'),

(0012, 
'/PE7045/assets/images/accom_id_0012/clippie_lodge.jpg', 'photo of entrance to the lodge', 
'/PE7045/assets/images/accom_id_0012/clippie_lodge2.jpg', 'photo of main living area with dining area and kitchen in the background', 
'/PE7045/assets/images/accom_id_0012/clippie_lodge3.jpg', 'photo of living area and the television', 
'/PE7045/assets/images/accom_id_0012/clippie_lodge4.jpg', 'photo of kitchen', 
'/PE7045/assets/images/accom_id_0012/clippie_lodge5.jpg', 'photo of dining area', 
'/PE7045/assets/images/accom_id_0012/clippie_lodge6.jpg', 'photo of first double bedroom', 
'/PE7045/assets/images/accom_id_0012/clippie_lodge7.jpg', 'photo of second double bedroom', 
'/PE7045/assets/images/accom_id_0012/clippie_lodge8.jpg', 'photo of bathroom', 
'/PE7045/assets/images/accom_id_0012/clippie_lodge9.jpg', 'photo of outdoor dining area'),

(0013, 
'/PE7045/assets/images/accom_id_0013/boom_house.jpg', 'photo of house from afar by cliffs next to Lock Ewe', 
'/PE7045/assets/images/accom_id_0013/boom_house2.jpg', 'close-up photo of outside of house', 
'/PE7045/assets/images/accom_id_0013/boom_house3.jpg', 'view of the Loch from the living area', 
'/PE7045/assets/images/accom_id_0013/boom_house4.jpg', 'photo of living area with kitchen and dining area in background', 
'/PE7045/assets/images/accom_id_0013/boom_house5.jpg', 'photo of kitchen', 
'/PE7045/assets/images/accom_id_0013/boom_house6.jpg', 'photo of attic with sofa bed', 
'/PE7045/assets/images/accom_id_0013/boom_house7.jpg', 'photo of main double bedroom', 
'/PE7045/assets/images/accom_id_0013/boom_house8.jpg', 'photo of bathroom', 
'/PE7045/assets/images/accom_id_0013/boom_house9.jpg', 'photo of second bedroom with two single beds'),

(0014, 
'/PE7045/assets/images/accom_id_0014/rientraid.jpg', 'photo of front of cottage with loch in the background', 
'/PE7045/assets/images/accom_id_0014/rientraid2.jpg', 'photo of living room', 
'/PE7045/assets/images/accom_id_0014/rientraid3.jpg', 'photo of dining area', 
'/PE7045/assets/images/accom_id_0014/rientraid4.jpg', 'photo of sitting room', 
'/PE7045/assets/images/accom_id_0014/rientraid5.jpg', 'photo of first double bedroom', 
'/PE7045/assets/images/accom_id_0014/rientraid6.jpg', 'photo of first bathroom', 
'/PE7045/assets/images/accom_id_0014/rientraid7.jpg', 'photo of second double bedroom', 
'/PE7045/assets/images/accom_id_0014/rientraid8.jpg', 'photo of third bedroom with two single beds and a cot', 
'/PE7045/assets/images/accom_id_0014/rientraid9.jpg', 'photo of outdoor viewing platform');