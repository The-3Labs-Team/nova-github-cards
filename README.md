<p align="center">
<img src="https://github.com/the-3labs-team/nova-github-cards/raw/HEAD/art/banner.png" width="100%" 
alt="Logo Nova Github Cards by The3LabsTeam"></p>

[![Latest Version on Packagist](https://img.shields.io/packagist/v/the-3labs-team/nova-github-cards.svg?style=flat-square)](https://packagist.org/packages/the-3labs-team/nova-github-cards)
[![Fix PHP code style issues](https://github.com/The-3Labs-Team/nova-github-cards/actions/workflows/lint.yml/badge.svg)](https://github.com/The-3Labs-Team/nova-github-cards/actions/workflows/lint.yml)
[![PHPStan](https://github.com/The-3Labs-Team/nova-github-cards/actions/workflows/analyse.yml/badge.svg)](https://github.com/The-3Labs-Team/nova-github-cards/actions/workflows/analyse.yml)
[![Maintainability](https://api.codeclimate.com/v1/badges/d06434af7ba21185c9b0/maintainability)](https://codeclimate.com/github/The-3Labs-Team/nova-github-cards/maintainability)
![License Mit](https://img.shields.io/github/license/murdercode/laravel-shortcode-plus)
[![Total Downloads](https://img.shields.io/packagist/dt/the-3labs-team/nova-github-cards.svg?style=flat-square)](https://packagist.org/packages/the-3labs-team/nova-github-cards)

# Nova Github Cards

Enhance your Laravel Nova experience by seamlessly integrating GitHub project cards into your dashboard. This powerful
package allows you to effortlessly display essential GitHub statistics, issues, commits, and other project information
directly within your Nova dashboard.

## Demo
<p align="center">
<img src="https://github.com/the-3labs-team/nova-github-cards/raw/HEAD/art/demo.png" width="100%" 
alt="Demo Nova Github Cards by The3LabsTeam"></p>


## Installation

You can install the package via composer:

```bash
composer require the-3labs-team/nova-github-cards
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
    'vendor' => 'YOUR-VENDOR',
    'repository' => 'YOUR-REPO-NAME',
    'branch' => 'main',
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

## Sponsor

<div>  
    <a href="https://www.tomshw.it/" target="_blank" rel="noopener noreferrer">
        <img  src="https://3labs-assets.b-cdn.net/assets/logos/banner-github/toms.png" alt="Tom's Hardware - Notizie, recensioni, guide all'acquisto e approfondimenti per tutti gli appassionati di computer, smartphone, videogiochi, film, serie tv, gadget e non solo" />  
    </a>
    <a href="https://spaziogames.it/" target="_blank" rel="noopener noreferrer" >
        <img src="https://3labs-assets.b-cdn.net/assets/logos/banner-github/spazio.png" alt="Spaziogames - Tutto sul mondo dei videogiochi. Troverai tantissime anteprime, recensioni, notizie dei giochi per tutte le console, PC, iPhone e Android." />
    </a>
    <br/>
    <a href="https://cpop.it/" target="_blank" rel="noopener noreferrer" >
        <img src="https://3labs-assets.b-cdn.net/assets/logos/banner-github/cpop.png" alt="Cpop - News, recensioni, guide su fumetto, cinema & serie TV, gioco da tavolo e di ruolo e collezionismo. Tutto quello di cui hai bisogno per rimanere aggiornato sul mondo della cultura pop"/>
    </a>
    <a href="https://data4biz.com/" target="_blank" rel="noopener noreferrer" >
        <img src="https://3labs-assets.b-cdn.net/assets/logos/banner-github/d4b.png" alt="Data4Biz - Sito dedicato alla trasformazione digitale del business" />
    </a>
    <br/>
    <a href="https://soshomegarden.com/" target="_blank" rel="noopener noreferrer" >
        <img src="https://3labs-assets.b-cdn.net/assets/logos/banner-github/sos.png" alt="SOS Home & Garden - Realtà dedicata a 360 gradi ai settori della casa e del giardino." />
    </a>
    <a href="https://global.techradar.com/it-it" target="_blank" rel="noopener noreferrer" >
        <img src="https://3labs-assets.b-cdn.net/assets/logos/banner-github/techradar.png" alt="Techradar - Le ultime notizie e recensioni dal mondo della tecnologia, su computer, sistemi per la casa, gadget e altro." />
    </a>
    <br/>
    <a href="https://aibay.it/" target="_blank" rel="noopener noreferrer" >
        <img src="https://3labs-assets.b-cdn.net/assets/logos/banner-github/aibay.png" alt="Aibay - Scopri AiBay, il leader delle notizie sull'intelligenza artificiale. Resta aggiornato sulle ultime innovazioni, ricerche e tendenze del mondo AI con approfondimenti, interviste esclusive e analisi dettagliate." />
    </a>
    <a href="https://coinlabs.it/" target="_blank" rel="noopener noreferrer" >
        <img src="https://3labs-assets.b-cdn.net/assets/logos/banner-github/coinlabs.png" alt="Coinlabs - Notizie, analisi approfondite, guide e opinioni aggiornate sul mondo delle criptovalute, blockchain e finanza" />
    </a>

</div>
