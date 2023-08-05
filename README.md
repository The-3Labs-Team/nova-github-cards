<p align="center">
<img src="https://github.com/the-3labs-team/nova-github-cards/raw/HEAD/art/banner.png" width="100%" 
alt="Logo Nova Github Cards by The3LabsTeam"></p>

# Nova Github Cards

Enhance your Laravel Nova experience by seamlessly integrating GitHub project cards into your dashboard. This powerful
package allows you to effortlessly display essential GitHub statistics, issues, commits, and other project information
directly within your Nova dashboard.

## Installation

You can install the package via composer:

```bash
composer required the-3labs-team/nova-github-cards
```

You can publish the config file with:

```bash
php artisan vendor:publish
```

and choose: `The3LabsTeam\NovaGithubCards\NovaGithubCardsServiceProvider`.

This is the contents of the published config file:

```php
<?php

return [
    'vendor' => 'The-3Labs-Team',
    'repository' => 'nospoiler',
    'branch' => 'master',
    'per_page' => 5,
    'cache_ttl' => 0, //in seconds

    'icons' => [
        'error' => [
            'icon' => 'x-circle',
            'iconClass' => 'text-red-500',
        ],
        'success' => [
            'icon' => 'check-circle',
            'iconClass' => 'text-green-500',
        ],
    ],
];
```

**Note:** this package uses [Laravel GitHub](GrahamCampbell\GitHub\GitHubServiceProvider), so you need to configure it
in your `config/github.php` file.

## Usage

Add your cards to your dashboard in the `cards` method, for example in `Dashboard\Main`:

```php
use \The3LabsTeam\NovaGithubCards\LatestCommitsTable;
use \The3LabsTeam\NovaGithubCards\LatestIssuesTable;
...

(new LatestCommitsTable()
(new LatestIssuesTable()

```

You can also override the config for each card, as follows:

```php
use \The3LabsTeam\NovaGithubCards\LatestCommitsTable;
...

(new LatestCommitsTable(
    name: 'The name of the card (string)', 
    vendor: 'The name of your vendor (string)', 
    repository: 'The name of your repo (string)', 
    branch: 'The name of your branch (string)', 
    perPage: 'Total of results (int)', 
    cache: 'The cache in seconds (int)')
 )
```
