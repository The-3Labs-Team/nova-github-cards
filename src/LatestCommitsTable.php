<?php

namespace The3LabsTeam\NovaGithubCards;

use Carbon\Carbon;
use Exception;
use GrahamCampbell\GitHub\Facades\GitHub;
use Illuminate\Support\Facades\Log;
use The3LabsTeam\NovaGithubCards\Abstract\GithubTable;

final class LatestCommitsTable extends GithubTable
{
    public $title = 'novaGithubCard.commitsTitle';

    public ?GitHub $commits = null;

    /**
     * Calculate the value of the metric.
     */
    public function calculate(): array
    {
        $this->commits = $this->getCommits();

        if (!$this->commits) {
            return $this->returnErrorMessage();
        }

        return $this->renderCommitsTable();

    }

    /**
     * Generate the fields for the latest commits
     *
     * @return array
     */
    public function renderCommitsTable()
    {
        $table = [];

        if (empty($this->commits)) {
            $table[] = $this->renderRow(title: (__('novaGithubCard.noCommitsFound')), subtitle: '', icon: 'information-circle', iconClass: 'text-gray-500');

            return $table;
        }

        foreach ($this->commits as $commit) {
            $title = $commit['commit']['message'];
            $subtitle = Carbon::parse($commit['commit']['author']['date'])->diffForHumans().' - '.(__('novaGithubCard.commitBy')).$commit['commit']['author']['name'];
            $url = $commit['html_url'];

            $table[] = $this->renderRow(title: $title, subtitle: $subtitle, url: $url);
        }

        return $table;
    }

    /**
     * Get commits from Github
     */
    public function getCommits(): ?GitHub
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

        return null;
    }
}
