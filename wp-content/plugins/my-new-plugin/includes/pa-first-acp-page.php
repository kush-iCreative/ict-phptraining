<div class="wrap">
    <h1>Repeater Field Settings</h1>
    <form method="post" action="options.php">
        <?php
        // Output security fields and settings internal logic
        settings_fields('pa-settings-group'); //data sent proper way from your plugin
        do_settings_sections('pa-settings-group');

        // Retrieve existing data from database
        $data = get_option('pa_repeater_data', []);
        ?>

        <div id="mfp-repeater-container">
            <?php
            // If no data exists, we create a dummy array with one empty row so the loop runs once
            $display_data = (!empty($data) && is_array($data)) ? $data : [['text' => '', 'number' => '']];

            foreach ($display_data as $index => $row) :
            ?>
                <div class="repeater-row" style="margin-bottom: 10px;">
                    <input type="text" name="pa_repeater_data[<?php echo $index; ?>][text]"
                        value="<?php echo esc_attr($row['text'] ?? ''); ?>" placeholder="Enter Text" />

                    <input type="number" name="pa_repeater_data[<?php echo $index; ?>][number]"
                        value="<?php echo esc_attr($row['number'] ?? ''); ?>" placeholder="0" />

                    <?php
                    // This makes the first field permanent
                    if ($index > 0) : ?>
                        <button type="button" class="remove-row">Remove</button>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>


        <button type="button" id="add-row" class="button">Add More Field</button>
        <hr>
        <?php submit_button(); ?>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('mfp-repeater-container');
        const addButton = document.getElementById('add-row');

        addButton.addEventListener('click', function() {
            const rowCount = container.getElementsByClassName('repeater-row').length;
            const newRow = document.createElement('div');
            newRow.className = 'repeater-row';
            newRow.style.marginBottom = '10px';
            newRow.innerHTML = `
            <input type="text" name="pa_repeater_data[${rowCount}][text]" placeholder="Enter Text" />
            <input type="number" name="pa_repeater_data[${rowCount}][number]" placeholder="0" />
            <button type="button" class="remove-row">Remove</button>
        `;
            container.appendChild(newRow);
        });

        container.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-row')) {
                e.target.parentElement.remove();
            }
        });
    });
</script>
