# Report Order Summary
Generate order summary based on dumped data with JSON line (.jsonl) format.

## How to use
```bash
# php bin/console report:order-summary [source-url-or-path] [output-file] [output-type:csv|jsonl]
php bin/console report:order-summary https://url/to/dumped/data.jsonl outputfile.csv csv
```

## Main Dependency
- [Json Collection Parser](https://github.com/MAXakaWIZARD/JsonCollectionParser) enable JSON line streaming to reduce memory usage
- [League CSV](https://csv.thephpleague.com) CSV Generator from ThePHPLeague



