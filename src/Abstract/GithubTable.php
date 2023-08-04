<?php

namespace The3LabsTeam\NovaGithubCards\Abstract;

use Laravel\Nova\Metrics\MetricTableRow;
use Laravel\Nova\Metrics\Table;


abstract class GithubTable extends Table
{

    protected ?string $vendor;
    protected ?string $repository;
    protected ?string $branch;
    protected ?int $per_page;
    protected ?int $cache;

    /**
     * Createa a new Github table istance
     */
    public function __construct(
        string $vendor = null,
        string $repository = null,
        string $branch = null,
        int $per_page = null,
        int $cache_ttl = null)
    {
        parent::__construct();
        $this->vendor = $vendor ?? config('nova-github-cards.vendor');
        $this->repository = $repository ?? config('nova-github-cards.repository');
        $this->branch = $branch ?? config('nova-github-cards.branch');
        $this->per_page = $per_page ?? config('nova-github-cards.per_page');
        $this->cache_ttl = $cache_ttl ?? config('nova-github-cards.cache_ttl');
    }

    /**
     * Determine the amount of time the results of the metric should be cached.
     *
     * @return \DateTimeInterface|\DateInterval|float|int|null
     */
    public function cacheFor()
    {
//        return now()->addMinutes($this->cache_ttl);
    }

    /**
     * Return an error message in Nova Table Row
     *
     * @return array
     */
    public function returnErrorMessage(): array
    {
        return [$this->renderRow(
            title: 'No response from the API',
            subtitle: 'Verify the configuration files or check that the GitHub access token is correctly',
            icon: config('nova-github-cards.icons.error.icon'),
            iconClass: config('nova-github-cards.icons.error.iconClass')
        )];
    }

    /**
     * Render a row in Nova table
     *
     * @param string $title
     * @param string $subtitle
     * @param string|null $icon
     * @param string|null $iconClass
     *
     * @return MetricTableRow
     */
    public function renderRow(
        string $title,
        string $subtitle,
        ?string $icon = null,
        ?string $iconClass = null)
    : MetricTableRow
    {
        return MetricTableRow::make()
            ->icon($icon ?? config('nova-github-cards.icons.success.icon'))
            ->iconClass($iconClass ?? config('nova-github-cards.icons.success.iconClass'))
            ->title($title)
            ->subtitle($subtitle);
    }

}
