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

    public $name = 'Github Commits';
    public array $commits = [];

    /**
     * Calculate the value of the metric.
     *
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        $this->commits = $this->getCommits();

        if (empty($this->commits)) {
            return $this->returnErrorMessage();
        } else {
            return $this->generateLatestCommitFields();
        }
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
            $title = $commit['commit']['message'];
            $subtitle = Carbon::parse($commit['commit']['author']['date'])->diffForHumans();

            $table[] = $this->renderRow($title, $subtitle);
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
     * Get commits from Github
     *
     * @return mixed
     */
    public function getCommits(): mixed
    {
        try {
            // @phpstan-ignore-next-line
            return GitHub::repo()->commits()->all(
                $this->vendor,
                $this->repository,
                ['sha' => $this->branch, 'per_page' => $this->per_page]);
        } catch (Exception $e) {
            Log::error($e);
        }

        return [];
    }
}
