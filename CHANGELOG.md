# Changelog

All notable changes to this project will be documented in this file.

This project adheres to [Semantic Versioning](http://semver.org/).

## [1.1.0]

Major bug fix - On first publish of area parent object, new child areas were being created, due to ensureElementalAreasExist() creating new areas on first publish of parent object. Was checking for published areas before the parent was finished writing to live, not finding them as the $owns cascade hadn't occurred yet, so created new ones.

## [1.0.0]

Initial Release
