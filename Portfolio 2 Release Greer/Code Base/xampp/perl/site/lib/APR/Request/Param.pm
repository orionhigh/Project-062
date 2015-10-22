# 
# /*
#  * *********** WARNING **************
#  * This file generated by My::WrapXS/2.12
#  * Any changes made here will be lost
#  * ***********************************
#  * 1. /xampp/perl/site/lib/ExtUtils/XSBuilder/WrapXS.pm:52
#  * 2. /xampp/perl/site/lib/ExtUtils/XSBuilder/WrapXS.pm:2068
#  * 3. Makefile.PL:193
#  */
# 


package APR::Request::Param;
require DynaLoader ;

use strict;
use warnings FATAL => 'all';

use vars qw{$VERSION @ISA} ;

push @ISA, 'DynaLoader' ;
$VERSION = '2.12';
bootstrap APR::Request::Param $VERSION ;

package APR::Request::Param;
use APR::Request;
use APR::Table;
use APR::Brigade;

sub upload_io {
    tie local (*FH), "APR::Request::Brigade", shift->upload;
    return bless *FH{IO}, "APR::Request::Brigade::IO";
}

sub upload_fh {
    my $fname = shift->upload_tempname(@_);
    open my $fh, "<", $fname
        or die "Can't open ", $fname, ": ", $!;
    binmode $fh;
    return $fh;
}

package APR::Request::Brigade;
push our(@ISA), "APR::Brigade";

package APR::Request::Brigade::IO;
push our(@ISA), ();


1;
__END__
