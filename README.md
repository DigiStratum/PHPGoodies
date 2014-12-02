# PHPGoodies

Within is a collection of PHP Goodies that are general purpose, but which I use on nearly every new project. There are obviously many, many choices out there for PHP class libraries, but over the years I have crafted my own which has given me a deeper understanding of the PHP language, its capabilities, common pit-falls, and best practices. This experience has been invaluable for me personally as it has made me a better developer, and ultimately saves me time for each future project that reuses one of these implementations that I know intimately.

Now I make these implementations available to the general public in the hopes that others will benefit as well from studying my approach and by saving time on implementing something similar on their own (not that I discourage that since, as I mentioned, I find that to be a valuable exercise). Each class/library will have its own readme within, so feel free to extract/read just what you want, or download the entire archive.

Happy coding!

## Testing

PHPUnit is used for unit test coverage. The code base is woefully shy of 100% test coverage right now, but it will improve in time. Get phpunit installed (`yum install phpunit`, `apt-get install phpunit`, or similar should do the trick depending on your *nix platform), then just run `phpunit` from the same directory that this README.md lives; phpunit will read the phpunit.xml configuration file to identify all the subdirectories throughout the code base where tests live and run the entire set of tests. For more isolated testing, you can also run `phpunit filenameTest.php` for any of the **/test/*Test.php files in the PHPGoodies code base to run just the tests for the named class. As the code base expands, I will be making a more concerted effort to ensure that test coverage is provided, especially for the most foundational classes upon which other classes are dependent - the more sophisticated a class becomes, the more difficult the testing becomes...


## Advantage Considerations

As I mentioned in opening, there are a great number of third party libraries available to accomplish your PHP goals, however there are two aspects to PHPGoodies which, over time, will distinguish it from the rest:

1) Cohesion across all the classes in the library which may be arbitrarily imported/instantiated into any application and used without fuss, and with confidence that the goodies with cross-dependencies will all be satisfied without the need to custom integration of third part code to get any of them working; and...

2) Steadfast dedication to the production of consistent, high quality code that is documented, tested, has usage examples ready to roll for pretty much everything, and leverages the best of the latest PHP object oriented capabilities while complying with common coding practicies.


## Design Conventions

There are some design conventions at play here that it may be helpful for the developer to understand. Perhaps this section of the document will end up with enough convention explanations that they warrant some grouping or organization, but for now here they are in no particular order other than as they occur to me while I am getting things together...


### Code Structure

* The code is organized such that a functional hierarchy falls out of the directory structure based on what the various goodies do and does not reflect any sort of functional dependency. I just wanted to make it easy for someone perusing the directory structure to look for goodies they are interested in based on what they want to accomplish without requiring them to understand my personal convoluted sense of the structure of the universe. Inside each directory there may be goodies, directories with resources related to those goodies (test/doc/example), or other directories with goodies in them. The examples are intended to be executed in place to exercise the goodies that they demonstrate in the directory below, and I try to keep the examples direct and succinct.

* The entire PHPGoodies file tree is intended to be an archive of resources that is downloaded to your host, placed OUTSIDE your application document root (if the goodies are to be used in an HTTP hosted application), and included into your project by whatever path reference you need to bring in PHPGoodies.php. Once you have that one script linked into your application, you may use the class loader methods of the PHPGoodies class to load up any of the other goodies with a relative, Java-like dotted path notation through the directory hierarchy without having to code any other directory paths into your application. Thus it is as simple as possible, with the single include, to gain access to hundreds of useful PHP Goodies that it can load for you. It is possible, of course, to simply include a specific goodie if you find the path to it into your application provided that that goodie does not have any other cross-dependencies - look for dependency usage and/or notes in the code to verify whether that is the case.

* The PHPGoodies namespace is utilized to have free reign over the naming of the PHPGoodies classes without concern for conflicting with the name of any class in your application or those of any other third party vendors. I have chosen to create a single level namespace to keep things simple and make all the goodies easy to access - sometimes it can be painful to work with packages that have deeply namespaced source collections (enough to make me wonder just what kinds of collisions they were anticipating, yikes!). For me, this means I have to be vigilant in ensuring that all of the PHPGoodies have distinct class names and if I end up in a situation with something that is a pretty generic name, I will simply err on the side of making the name a bit more specific to the context that it is used in.


### OOP Practices

* Scope (public|protected|private) is used to regulate the usage of various properties/methods of objects/interfaces. My intention is to produce code that is unit testable, and defends data properties from direct access in order to ensure that the behavior may be modified in the future with minimal impact to the users of those objects. These decisions are not taken lightly, but I will modify them occasionally if there is a compelling reason to do so. I tend to limit the use of private as it makes it impossible to override those things in extended classes; I generally only use private scope on data properties if they are really important and I feel I have adequate exposure to them through accessor methods, and on methods if I feel they are highly task-specific for the implementation at hand and that the thing that uses them is what would really be overridden if a behavior change is desired in an extended class.

* Unit testing has been suffereing a bit as I have been using example applications that demonstrate functionality for each of the goodies, but I do need to go back-fill the various unit tests. There is no top-level unit test suite yet as each goodie is individually testable (where tests have been provided), however I will make one so that they are all gathered together and executed in a single step. This is especially important as the code base begins to grow and changes are popping up all over the place as inter-dependencies are introduced.

* On the surface, dependency injection has been suffering a bit as well as I have been relying on the ability to spawn new class instances on the fly. What I am thinking to do with this is produce a test variant of the PHPGoodies class loader methods such that spawned instances will be able to deliver injected classes/instances for test purposes. If dependency injection solves testability problems, my use of a centralized class loader achieves the same goal without the strange pre-definition of dependencies needed in the parent class that typically comes along with typical dependency injection.

* Cross-dependency is something that is re-emerging as an implementation pattern prevalent in my design work over the past fifteen years or so. My goal is to make as many goodies as I can that may be used independently to the extent that they could be plucked right out of the PHPGoodies code tree and dropped anywhere into another application and used free and clear. From there I am constructing "enhanced" goodies that have dependencies on other goodies and automatically load them as needed - these would either need to remain in the PHPGoodies tree where they are in order to resolve the loading paths and such correctly, or would require some manual code changes to correct the paths if you wanted to extract just the chain of goodies that you need for your project. I try to keep each of these enhanced goodies as simple as possible to minimize the tendrils of impact that fall out of code changes - it makes my life easier as maintainer, and your life easier for integration and understanding of how and where things lay out and why. Because PHP is a "loosely typed" language, it can not help you figure out what is missing when a method expects some object class to be provided as an argument and you give it something else. So we have to do that ourselves, and that mean cross-linking these dependencies as needed. On super rare occasion I have found a need (like once or twice, ever) for two classes to cross-reference each other and in those cases care was taken to not create a temporal vortex of infinite recursion, etc; generally I avoid that pattern.




