@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block; text-decoration: none;">
<table role="presentation" cellpadding="0" cellspacing="0" border="0" align="center">
<tr>
<td align="center" valign="middle" style="background-color: #FF4433; border-radius: 12px; width: 40px; height: 40px; text-align: center; vertical-align: middle; box-shadow: 0 4px 12px rgba(255, 68, 51, 0.25);">
<span style="color: #ffffff; font-size: 20px; line-height: 40px;">&#9889;</span>
</td>
<td style="padding-left: 12px; text-align: left; vertical-align: middle;">
<span style="color: #18181b; font-family: 'Instrument Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; font-size: 20px; font-weight: 700; letter-spacing: -0.02em;">{{ $slot }}</span>
<br>
<span style="color: #71717a; font-family: 'Instrument Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; font-size: 12px; font-weight: 500;">Shorten. Share. Track.</span>
</td>
</tr>
</table>
</a>
</td>
</tr>
