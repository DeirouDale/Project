document.addEventListener('DOMContentLoaded', function () {
    // Functionality for export button
    document.getElementById('export-button').addEventListener('click', function () {
        const table = document.querySelector('#table-content table');
        if (!table) return;

        // Create a workbook from the table
        const wb = XLSX.utils.table_to_book(table);

        // Get the table title and clean it for use as a filename
        const tableTitle = document.getElementById('table-title').innerText.replace(/<\/?[^>]+(>|$)/g, "");

        // Create a filename with the school name and table details
        // Adjust the PHP variable as necessary
        const schoolName = "<?php echo $school_name; ?>";
        const year = "<?php echo $year; ?>";
        const month = "<?php echo $month; ?>";
        const day = "<?php echo $day; ?>";
        const fileName = `${schoolName} Table_1 Learners by Program SY ${year} As of ${month} ${day}.xlsx`;

        // Write the workbook to a file and trigger the download
        XLSX.writeFile(wb, fileName);
    });
});
