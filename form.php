<?php
function verifyToken(string $token, string $ip): array {
  $payload = http_build_query([
    "secret" => "ES_45332c34bb3a4c0b9def22e0b6362a9a",
    "response" => $token,
    "remoteip" => $ip,
    "sitekey" => "54c222d6-535e-4b7e-9476-dd144a00dc3c",
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