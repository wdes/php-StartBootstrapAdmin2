<br>
<div class="row justify-content-center" id="flash_messages">
    <?php
    foreach ($this->getFlashMessages() as $alert) {
        echo sprintf(
            '<div class="alert alert-%s" role="alert">%s</div>',
            $this->secure($alert['level']),
            $this->secure($alert['message'])
        );
    }
    ?>
</div>