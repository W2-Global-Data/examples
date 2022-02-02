package com.w2.company;

import org.json.simple.parser.ParseException;
import java.io.IOException;
import java.net.URI;
import java.net.http.HttpClient;
import java.net.http.HttpRequest;
import java.net.http.HttpResponse;

public class Main {

    public static void main(String[] args) throws IOException, InterruptedException, ParseException {

        String inputJson = "{ \"Bundle\":\"PepDeskCheck\", \"Data\":{\"NameQuery\":\"David Cameron\"},\"Options\":{\"Sandbox\":\"true\"}, \"ClientReference\":\"Client Testing\" }";

        HttpClient client = HttpClient.newHttpClient();

        HttpRequest request = HttpRequest.newBuilder()
                .uri(URI.create("https://api.w2globaldata.com/kyc-check?api-version=1.2"))
                .headers("Accept-Encoding", "gzip, deflate")
                .headers("Content-Type", "application/json")
                .headers("Authorization", "basic api-key")
                .version(HttpClient.Version.HTTP_2)
                .POST(HttpRequest.BodyPublishers.ofString(inputJson))
                .build();

        HttpResponse<String> response = client.send(request, HttpResponse.BodyHandlers.ofString());
        String responseBody = response.body();
        int responseStatusCode = response.statusCode();

        System.out.println("Response body: " + responseBody);
        System.out.println("Response status code: " + responseStatusCode);
    }
}
