<html xmlns="http://www.w3.org/1999/xhtml">
<head id="Head1" runat="server">
    <title>BP PGW Test</title>
    <link href="Css/Style.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <form id="form1" runat="server">
    <table width="100%" cellspacing="0" cellpadding="0" align="center">
        <tr>
            <td>
                <table class="MainTable" cellspacing="5" cellpadding="1" align="center">
                    <tr class="HeaderTr">
                        <td colspan="2" align="center" height="25">
                            <span class="HeaderText">CallBack Params</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="LabelTd">
                            <span>RefId</span>
                        </td>
                        <td>
                            <span><?php echo $_POST['RefId']; ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td class="LabelTd">
                            <span>ResCode</span>
                        </td>
                        <td>
                            <span><?php echo $_POST['ResCode']; ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td class="LabelTd">
                            <span>SaleOrderId</span>
                        </td>
                        <td>
                            <span><?php echo $_POST['SaleOrderId']; ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td class="LabelTd">
                            <span>SaleReferenceId</span>
                        </td>
                        <td>
                            <span><?php echo $_POST['SaleReferenceId']; ?></span>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    </form>
</body>
</html>
