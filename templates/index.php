<?php $this->render('head'); ?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>

<!-- Content Row -->
<div class="row">
<?php

foreach ($this->getDashboardItems() as $item) {
    if ($item['cards'] ?? false) {
        foreach ($item['cards'] as $card) {
            $icon = $this->safe($card['icon'] ?? '');
            $cardColor = $this->safe($card['color'] ?? 'primary');
            $text = $this->safe($card['text'] ?? '');
            $textColor = $this->safe($card['text-color'] ?? 'primary');
            $value = $this->safe($card['value'] ?? '');
            echo <<<HTML
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-{$cardColor} shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-{$textColor} text-uppercase mb-1">{$text}</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{$value}</div>
                            </div>
                            <div class="col-auto">
                                <i class="{$icon} text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
HTML;
        }
        continue;
    }
}
?>
</div>
<?php $this->render('foot'); ?>