@extends('layouts.app')

<table>
    <tr>
        <td colspan="8" align="right">
            <button class="btn btn-success play-next">Go play!</button>
            <button class="btn btn-success" id="clear">Clear!</button>
            <input type="hidden" name="current_week" value="1" >
        </td>
    </tr>
</table>
<div id="result"></div>