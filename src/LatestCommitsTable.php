<?php

namespace The3LabsTeam\NovaGithubCards;

use Carbon\Carbon;
use GrahamCampbell\GitHub\Facades\GitHub;
use Illuminate\Support\Facades\Log;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\MetricTableRow;
use Laravel\Nova\Metrics\Table;

class LatestCommitsTable extends Table
{
    public $name = 'GitHub™ - Ultimi sviluppi';
    public array $commits = [];

    /**
     * Calculate the value of the metric.
     *
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {

        $this->commits = $this->getGithubCommits();

        if (empty($this->commits)) {
            return $this->returnErrorMessage();
        } else {
            return $this->generateLatestCommitFields();
        }
    }

    /**
     * Determine the amount of time the results of the metric should be cached.
     *
     * @return \DateTimeInterface|\DateInterval|float|int|null
     */
    public function cacheFor()
    {
         return now()->addMinutes(5);
    }

    /**
     * Generate the fields for the latest commits
     *
     * @return array
     */
    public function generateLatestCommitFields()
    {
        $data = [];

        foreach ($this->commits as $commit) {
            $data[] = MetricTableRow::make()
                ->icon(config('nova-github-cards.icons.success.icon'))
                ->iconClass(config('nova-github-cards.icons.success.iconClass'))
                ->title($commit['commit']['message'])
                ->subtitle(
                    $commit['commit']['author']['name'].' - '.Carbon::parse($commit['commit']['author']['date'])->format('d/m/Y H:i:s')
                );
        }

        return $data;
    }

    public function returnErrorMessage(): array
    {
        return [
            MetricTableRow::make()
                ->icon(config('nova-github-cards.icons.error.icon'))
                ->iconClass(config('nova-github-cards.icons.error.iconClass'))
                ->title('No response from the API')
                ->subtitle('Verify the configuration files or check that the GitHub access token is correctly'),
        ];
    }

    /**
     * @param $githubCommits
     * @return mixed
     */
    public function getGithubCommits(): mixed
    {
        try {
            return GitHub::repo()->commits()->all(
                config('nova-github-cards.organizations'),
                config('nova-github-cards.repository'),
                ['sha' => config('nova-github-cards.branch'), 'per_page' => config('nova-github-cards.per_page')]);
        } catch (\Exception $e) {
            Log::error($e);
        }
        return [];
    }
}
