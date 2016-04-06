cd "/Users/dkloepfer/iliasInstalls/immutableBench/"
set terminal "png"
set output "result_t.png"
set multiplot
set key box linestyle -1

set xlabel "ammount of operations"
set ylabel "time / sec"
set xrange [0:1000000]
set xtics 100000,300000,1000000
set key at 900000,1
plot "data_m_i_r.dat" u 1:3 t "mut" w points pointtype 7, "data_m_i_r.dat" u 1:5 t "immut" w points pointtype 5, "data_m_i_r.dat" u 1:7 t "ref" w points pointtype 6, "data_m_i_r.dat" u 1:(($5-$3)) t "(immut - mut)" w points pointtype 13

set size 0.5,0.4
set origin 0.1,0.55
set xrange [100:1600]
set yrange [0:0.008]
set xlabel ""
set ylabel ""
set xtics 100,500
set ytics 0,.002,0.008
unset key
unset arrow
plot "data_m_i_r.dat" u 1:3 t "mut" w points pointtype 7, "data_m_i_r.dat" u 1:5 t "immut" w points pointtype 5, "data_m_i_r.dat" u 1:7 t "ref" w points pointtype 6, "data_m_i_r.dat" u 1:(($5-$3)) t "(immut - mut)" w points pointtype 13

unset multiplot

set terminal "png"
set output "result_m.png"
set multiplot

unset size
unset origin
set key at 900000,1500
set xrange [100:1000000]
set yrange [0:2000]
set xlabel "ammount of operations"
set ylabel "memory/ byte"
set xrange [0:1000000]
set xtics 100000,300000,1000000
set ytics 0,1000,2000
plot "data_m_i_r.dat" u 1:2 t "mut" w points pointtype 7, "data_m_i_r.dat" u 1:4 t "immut" w line , "data_m_i_r.dat" u 1:6 t "ref" w points pointtype 6, "data_m_i_r.dat" u 1:(($4-$2)) t "(immut - mut)" w points pointtype 13