# Changelog for zf-bernard
 
Yes, we are sorry this only starts at our 1.0.0

## New in 1.0.0

* Renamed console task from `bernard consume` to `interactive-solutions:bernard:consume`
* Added `ClearObjectManager` and `which should be injected into the `InteractiveSolutions\Bernard\EventDispatcherInterface` using a `DelegateFactory` 
* Renamed `InteractiveSolutions\Bernard\Middleware\Producer` to `InteractiveSolutions\Bernard\Producer`
* Renamed `InteractiveSolutions\Bernard\Serializer\AbstractExplicitMessage` to `InteractiveSolutions\Bernard\Message\AbstractExplicitMessage`
* Removed the JMSSerializer as it's currently not supported by bernard
* Renamed our internal serializer to `ExplicitNormalizer` because that is what bernard is now calling it.
