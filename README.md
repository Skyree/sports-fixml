# sports-fixml

_Removes duplicate waypoints from tcx or gpx exports to avoid activity time loss when syncing to Strava_

### Why?
Duplicate waypoints happen when you encounter GPS loss during your sport session.

When importing such file to Strava, sections of duplicate waypoints will be considered as pauses, therefore changing your activity time.

This project aims to remove the duplicate waypoints in order to have an activity time which reflects more accurately your initial time, at the price of a lower trace accuracy.

Please be aware that it might remove your pauses.

### Requirements
* php 7.1
* ext-dom

### Installation
Clone or download the repository and simply run `composer install`

### Getting started
Run the following command
```
php console [directory] [strategy]
```
* `directory` : path to your activities export files
* `strategy` : `left` or `right` (optional, default: left)
The strategy is used to remove duplicate waypoints either from the left or from the right
It is recommended to use the left strategy for more accurate results

Fixed files will be saved in a `fixed` subdirectory within the provided directory.
