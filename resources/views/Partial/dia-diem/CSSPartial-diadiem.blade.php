<style type="text/css">
    .log {
        position: absolute;
        top: 5 px;
        left: 5 px;
        height: 150 px;
        width: 250 px;
        overflow: scroll;
        background: white;
        margin: 0;
        padding: 0;
        list - style: none;
        font - size: 12 px;
    }

    .log - entry {
        padding: 5 px;
        border - bottom: 1 px solid #d0d9e9;
    }

    .log - entry: nth - child(odd) {
        background - color: #e1e7f1;
    }

    /** Style for the info bubble content */
    .H_ib_body {
        width: 200px;
    }

    /** Style for the info bubble tail */
    .H_ib.H_ib_top .H_ib_tail::after {
        border-color: rgb(45, 213, 201) transparent !important;
    }
</style>
