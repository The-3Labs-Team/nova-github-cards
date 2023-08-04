# nova-github-cards

## Installation

You can install the package via composer:
```bash
composer ...
```

You can publish the config file with:
```bash
php artisan vendor:publish
```
**and select: `The3LabsTeam\NovaGithubCards\NovaGithubCardsServiceProvider`.**

This is the contents of the published config file:

```php
<?php

return [
    'vendor' => '...',
    'repository' => '...',
    'branch' => '...',
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

    'commits' => [
        'message' => 'Al momento nessuna Implementazioni presente',
    ],

    'issues' => [
        'message' => 'Al momento nessuna Issue presente',
    ]
];

```

You can publish the GitHub config file with:
```bash
php artisan vendor:publish
```
**and select: `GrahamCampbell\GitHub\GitHubServiceProvider`.**

In this file you can set the options for the GitHub client.
You can choose from several options:
- Main
- App
- Jwt
- Private

**The config file is documented, so choose the option that best suits your needs.**

## Usage

```php
use \The3LabsTeam\NovaGithubCards\LatestCommitsTable;
use \The3LabsTeam\NovaGithubCards\LatestIssuesTable;
...

(new LatestCommitsTable(name: 'The name of the card'))
(new LatestIssuesTable(name: 'The name of the card'))
```
You can also override the config files like this:
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

