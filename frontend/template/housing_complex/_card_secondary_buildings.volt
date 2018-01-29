<tr onclick="window.location.href='/baza-novostroek/zhk-{{obj.getSlug()}}/vtorichnoe-zhile/{{apart.getTotalRoomCount()}}-komnatnaya-kvartira/card-{{apart.getId()}}'">
	<td  data-label="Комнат:" class="b-housing-complex__wt_rooms">
	{% if apart.getTotalRoomCount() > 0 %}
		{{apart.getTotalRoomCount()}}-комнатная
	{% else %}
		Студия
	{% endif %} 
	</td>
	<td data-label="Площадь:" >{{apart.getTotalSquare()}} м<sup><small>2</small></sup></td>
	<td data-label="Этажность:" class="b-housing-complex__floor">{{ apart.getStorey()}}/{{ apart.getStoreyCount() }}</td>
	<td data-label="Цена:" class="b-housing-complex__float-right">{{ apart.getPriceFormat()}} руб.</td>
</tr>
