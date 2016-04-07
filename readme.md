# Immutable Objects Benchmark

This repository provides you with a benchmarking script to check temporal and memory performance difference between mutable and immutable objects. We find an increase in running time, but no change in memory consumption. Allthough there _is_ an increase in running time, it does not change the order of magnitude. In our case we find an average time difference of about 2E-6 seconds per operation. Assuming 10E3 operations per pageload, we expect that once we have a large offset due to the environment (other objects, which are not immutable, as well as database interaction) it will not be possible to tell the difference.

Our sample, **class.immutableSample.php**, is a simple object with a series of public setter that may operate in an immuable (a new immutable objects will be created, whenever you try to set a property, being identical to the object the operation is called on, up to the changed property) or a mutable (the object itself will be changed) way depending on the **$mutable** property. We create such an object and perform setter operations on them. The ammount of this operations is variable and the type of any single operation is chosen randomly at runtime, we thus hope to represent a broad variety of usecases with this benchmark. 

The results are presented in folloing two graphs:

![graph of temporal performance](result_t.png "graph of temporal performance")

Here we see the duration of execution depending on the numbers of operation. Obviously it takes longer to deal with immutable objects. The overhead above reference offset is roughly four times bigger for immutable objects compared to their mutable variants. However, the difference per operation is only about 2 microseconds (2,5 GHz Intel Core i5, 8 GB 1600 MHz DDR3, OS X El Capitan, PHP 5.5.29), which makes it relevant only on the scale of 10E5 operations.

![graph of memory consumption](result_m.png "graph of memory consumption")

Here we see the memory conumption depending on the numbers of operation. It's same for both, mutable and nonmutable, objects and independent of ammount of the operations. The reason for this is the reference counting way of memory allocation of php, i.e. once an object is not referenced anymore, it's memory is released.

