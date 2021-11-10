
/*
 *======================================================
 * Alpha Upsell Loader
 *======================================================
*/

.alpha-upsell-loader {
    border: 2px solid #f3f3f3;
    border-radius: 50%;
    border-top: 2px solid #3498db;
    width: 15px;
    height: 15px;
    -webkit-animation: alpha_upsell_spin 0.5s linear infinite;
    animation: alpha_upsell_spin 0.5s linear infinite;
    display: inline-block;
    margin-top: 2px;
    margin-left: 6px;
}

/* Safari */
@-webkit-keyframes alpha_upsell_spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes alpha_upsell_spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

/* <---------------- Alpha Upsell Loader Close --------------> */