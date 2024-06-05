<script>
$(document).ready(function() {
    <?php foreach($votes as $vote): ?>

        <? echo $total_votes = $vote['option1_votes'] + $vote['option2_votes']; ?>

        const ctx_<?php echo $poll["id"]; ?> = $('#chart_<?php echo $poll["id"]; ?>');

        new Chart(ctx_<?php echo $poll["id"]; ?>, {
            type: 'bar',
            data: {
                labels: ['<?php echo $poll["option_1"]?>', '<?php echo $poll["option_2"]?>'],
                datasets: [{
                    
                    label: 'Votes',
                    data: [<?php echo $vote['option1_votes']; ?>, <?php echo $vote['option2_votes']; ?>],
                    borderWidth: 1,
                    backgroundColor: [
                        'rgb(129 140 248)',
                        'rgb(55 48 163)',
                    ],
                    borderColor: [
                        'rgb(55 48 163)',
                        'rgb(55 48 163)',
                    ],
                    barThickness: 60, // Set this to the desired width
                    maxBarThickness: 70, // Set this to the maximum desired width
                }]
            },
            options: {
                layout: {
                    padding: 0
                },
                plugins: { 
                    title: {
                        display: true, 
                        text: "<?php echo $poll['question']; ?>" ,
                        padding: {
                            top: 10,
                            bottom: 10
                        },
                        font: {
                            size: 22,
                        }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false,
                        },
                    },
                    y: {
                        ticks: {
                            display: false,
                        },
                        beginAtZero: true,
                        grid: {
                            display: false,
                        },
                        border: {
                            display: false,
                        },
                    },
                },
                legend: {
                    display: false,
                }
            },
        });
    <?php endforeach; ?>
});
</script>
