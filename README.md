# Sorted Linked List

Yet another PHP library implementing a sorted linked list. :)

### Installation

This is the place where you usually find a command like `composer require nemrtvej/sorted-linked-list`.
Well, this is not the case as this repository is not registered on packagist because this is just a demo project :).
Sorry!

If you REALLY wish to use this project, this might help you: https://barryvanveen.nl/articles/55-installing-a-private-package-with-composer

```
"repositories":[
    {
        "type": "vcs",
        "url": "git@github.com:nemrtvej/sorted-linked-list.git"
    }
]
```

## Usage

SortedLinkedList cannot be instantiated via constructor, you must use the factory methods:

- `Nemrtvej\SortedLinkedList\SortedLinkedList::int()` for integer-based sorted linked list.
- `Nemrtvej\SortedLinkedList\SortedLinkedList::string()` for string-based sorted linked list.

By default, the lists are ordered in ascending order.
This can be changed by calling `SortedLinkedlist::setComparator()`.

`Nemrtvej\SortedLinkedList\CommonComparators` can provide you with some ready-made comparators.

See contents of [examples](./examples/) directory for some example usage.

## Further development

This library was developed with docker in mind. The attached docker image contains also an xdebug.
For basic development:
1. Make sure your environment contains variables PUID and PGID with the ID of your user and group respectively.
   - This can be done for example by adding this code into your .bashrc (or other shell rc file)
       ```shell
			export PUID=$(id -u)
			export PGID=$(id -g)
   - Other approach might be utilizing `docker-compose.override.yaml`...
2. Clone this repository.
3. run `make reset`
4. ???
4. Profit! :)

Before pushing new changes, running `make check` will provide you with some preliminary feedback about the healthiness
of your change.

If you have IntelliJ IDEA, have a look at [docs/setup-idea.md](docs/setup-idea.md) how you can setup your IDE and enjoy the xdebug and phpunit integrations.
PHPStorm has config is quite similar so fingers crossed.
