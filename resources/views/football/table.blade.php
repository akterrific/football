<table border="1" width="50%">
    <tr>
        <th colspan="7">League Table</th>
        <th>Match Results</th>
    </tr>
    <tr>
        <td>Teams</td>
        <td>PTS</td>
        <td>P</td>
        <td>W</td>
        <td>D</td>
        <td>L</td>
        <td>GD</td>
        <td rowspan="5">
            @foreach ($matches as $matche)
                {{$matche['home_team']['name']}} {{$matche['goal_home_team']}}:{{$matche['goal_guest_team']}} {{$matche['guest_team']['name']}} <br>
            @endforeach
        </td>
    </tr>
    @foreach ($teams as $team)
        <tr>
            <td>{{ $team->name }}</td>
            <td>{{ $team->points }}</td>
            <td>{{ $team->games }}</td>
            <td>{{ $team->win }}</td>
            <td>{{ $team->draws }}</td>
            <td>{{ $team->lose }}</td>
            <td>{{ $team->goal_differential }}</td>
        </tr>
    @endforeach
    <tr>
        <td>
            <button class="btn btn-success play-all">Play all</button>
        </td>
        <input type="hidden" name="current_week" value="1">
        <td colspan="8" align="right"> <button class="btn btn-success play-next">Next week</button></td>
    </tr>
</table>