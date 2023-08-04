<?php

namespace The3LabsTeam\NovaGithubCards;

use Carbon\Carbon;
use Exception;
use GrahamCampbell\GitHub\Facades\GitHub;
use Illuminate\Support\Facades\Log;
use Laravel\Nova\Http\Requests\NovaRequest;
use The3LabsTeam\NovaGithubCards\Abstract\GithubTable;

final class LatestIssuesTable extends GithubTable
{
    public $title = 'novaGithubCard.issuesTitle';

    public array $issues = [];

    /**
     * Calculate the value of the metric.
     */
    public function calculate(NovaRequest $request): mixed
    {
        $this->issues = $this->getIssues();

        if (empty($this->issues)) {
            return $this->returnErrorMessage();
        }

        return $this->renderIssuesTable();

    }

    /**
     * Generate the fields for the latest issues0
     *
     * @return array
     */
    public function renderIssuesTable()
    {
        $table = [];

        if (empty($this->issues)) {
            $table[] = $this->renderRow((__('novaGithubCard.noIssuesFound')), '');

            return $table;
        }

        foreach ($this->issues as $issue) {

            $title = $issue['title'];
            $assigneeName = $issue['assignee'] != null ? (__('novaGithubCard.assigned')).$issue['assignee']['login'] : (__('novaGithubCard.assign'));
            $subtitle = Carbon::parse($issue['created_at'])->diffForHumans().' - '.$assigneeName;
            $icon = $issue['assignee'] != null ? 'tag' : 'plus-circle';
            $url = $issue['html_url'];

            $table[] = $this->renderRow(title: $title, subtitle: $subtitle, url: $url, icon: $icon, iconClass: 'text-gray-500');
        }

        return $table;
    }

    /**
     * Get issues from Github
     */
    public function getIssues(): mixed
    {
        //        dd(
        //            Github::issues()->all(
        //                $this->vendor,
        //                $this->repository,
        //                ['sha' => $this->branch, 'per_page' => $this->per_page])
        //        );
        try {
            // @phpstan-ignore-next-line
            return Github::issues()->all(
                $this->vendor,
                $this->repository,
                ['sha' => $this->branch, 'per_page' => $this->per_page]);
        } catch (Exception $e) {
            Log::error($e);
        }

        return [];
    }
}
