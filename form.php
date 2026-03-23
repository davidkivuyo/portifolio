<?php
function verifyToken(string $token, string $ip): array {
  $payload = http_build_query([
    "secret" => "ES_45332c34bb3a4c0b9def22e0b6362a9a",
    "response" => $token,
    "remoteip" => $ip,
    "sitekey" => "49ec61e6-7e2a-4e0c-9c68-745276e42d22",
  ]);
  $ctx = stream_context_create([
    "http" => [
      "method" => "POST",
      "header" => "Content-type: application/x-www-form-urlencoded\r\n",
      "content" => $payload,
      "timeout" => 5,
    ],
  ]);
  $raw = file_get_contents(
    "https://api.hcaptcha.com/siteverify",
    false,
    $ctx
  );
  $j = json_decode($raw, true);
  if (!empty($j["success"])) {
    return [true, []];
  }
  return [false, $j["error-codes"] ?? []];
}

?>